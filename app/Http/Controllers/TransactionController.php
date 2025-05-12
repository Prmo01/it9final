<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // Display the transaction page (cart)
    public function index()
    {
        $cart = Session::get('cart', []);
        
        // Calculate the total cost
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('transaction.index', compact('cart', 'total'));
    }

    // Add product to the cart by barcode or name
    public function addProduct(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|max:255',
        ]);

        $product = Product::where('barcode', $request->product_code)
                        ->orWhere('name', 'like', '%' . $request->product_code . '%')
                        ->first();

        if (!$product) {
            return redirect()->route('transaction.index')->with('error', 'Product not found!');
        }

        if ($product->quantity < 1) {
            return redirect()->route('transaction.index')->with('error', 'Product is out of stock!');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->product_id])) {
            $currentQty = $cart[$product->product_id]['quantity'];
            if ($currentQty + 1 > $product->quantity) {
                return redirect()->route('transaction.index')->with('error', 'Cannot exceed available stock!');
            }
            $cart[$product->product_id]['quantity'] += 1;
        } else {
            $cart[$product->product_id] = [
                'id'       => $product->product_id,
                'name'     => $product->name,
                'price'    => $product->sell_price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('transaction.index')->with('success', 'Product added!');
    }

    // Update quantity of a product in the cart
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($request->quantity > $product->quantity) {
            return response()->json(['error' => 'Quantity exceeds available stock'], 400);
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Product not in cart'], 404);
    }

    // Remove a product from the cart
    public function removeProduct($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return redirect()->route('transaction.index')->with('success', 'Product removed!');
    }

    // Complete the transaction (purchase)
    public function completeTransaction(Request $request)
    {
        $cart = Session::get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('transaction.index')->with('error', 'Cart is empty!');
        }
    
        // Get discount from the form, default to 0 if not provided
        $discount = $request->input('discount', 0); 
    
        // Calculate total, including tax
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    
        $totalWithTax = $total * 1.12; // 12% Tax
    
        // Apply the discount to the total amount including tax
        $finalTotal = $totalWithTax - $discount;
    
        if ($request->payment_amount < $finalTotal) {
            return redirect()->route('transaction.index')->with('error', 'Insufficient payment amount!');
        }
    
        // Get the payment method from the form
        $paymentMethod = $request->input('payment_method'); 
    
        // Create the transaction record and get the transaction_id
        $transaction = Transaction::create([
            'total' => $total,
            'discount' => $discount, // Save discount
            'total_with_tax' => $totalWithTax,
            'payment_method' => $paymentMethod,
            'payment_amount' => $request->payment_amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Ensure that transaction was created successfully and has an ID
        if (!$transaction || !$transaction->id) {
            return redirect()->route('transaction.index')->with('error', 'Transaction creation failed!');
        }
    
        // Insert transaction items and update stock for each item in the cart
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                // Insert each item into the transaction_items table
                TransactionItem::create([
                    'transaction_id' => $transaction->id, // Use the correct transaction_id
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => 0, // You can handle item-specific discounts if needed
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Deduct stock after the sale
                $product->quantity -= $item['quantity'];
                $product->save();
            }
        }
    
        // Clear the cart session
        Session::forget('cart');
    
        return redirect()->route('transaction.index')->with('success', 'Transaction completed!');
    }
}
