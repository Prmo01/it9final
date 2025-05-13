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
    public function index()
    {
        $products = Product::all();
        
        $cart = session('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('transaction.index', compact('products', 'cart', 'total'));
    }

    public function addProduct(Request $request)
{
    $request->validate([
        'product_code' => 'required|string|max:255',
    ]);

    $product = Product::where('barcode', $request->product_code)
                    ->orWhere('name', 'like', '%' . $request->product_code . '%')
                    ->orWhere('product_id', $request->product_code)
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

    public function removeProduct($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return redirect()->route('transaction.index')->with('success', 'Product removed!');
    }

    public function completeTransaction(Request $request)
{
    $cart = Session::get('cart', []);

    if (empty($cart)) {
        return redirect()->route('transaction.index')->with('error', 'Cart is empty!');
    }

    $request->validate([
        'discount' => 'nullable|numeric|min:0',
        'payment_amount' => 'required|numeric|min:0',
        'payment_method' => 'required|in:cash,card,online',
    ]);

    $discount = $request->input('discount', 0);

    $total = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['quantity'];
    });

    $totalWithTax = $total * 1.12; 

    $finalTotal = $totalWithTax - $discount;

    if ($request->payment_amount < $finalTotal) {
        return redirect()->route('transaction.index')->with('error', 'Insufficient payment amount!');
    }

    $paymentMethod = $request->input('payment_method');

    $transaction = Transaction::create([
        'total' => $total,
        'discount' => $discount,
        'total_with_tax' => $totalWithTax,
        'payment_method' => $paymentMethod,
        'payment_amount' => $request->payment_amount,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if (!$transaction) {
        return redirect()->route('transaction.index')->with('error', 'Failed to create transaction!');
    }

    $errors = []; 

    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        if ($product) {
            if ($product->quantity < $item['quantity']) {
                $errors[] = "Insufficient stock for product: {$product->name}";
                continue;
            }

            TransactionItem::create([
                'transaction_id' => $transaction->transaction_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $product->quantity -= $item['quantity'];
            $product->save();
        } else {
            $errors[] = "Product not found for ID: {$item['id']}";
        }
    }

    if (!empty($errors)) {
        return redirect()->route('transaction.index')->with('error', implode(', ', $errors));
    }

    Session::forget('cart');

    $transaction->load('items.product');

    return redirect()->route('transaction.index')
                     ->with('success', 'Transaction completed!')
                     ->with('showReceiptModal', true)
                     ->with('transaction', $transaction);
}
}
