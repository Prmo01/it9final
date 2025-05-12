<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockOrder;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('quantity', '<', 5)->get();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $recentTransactions = Transaction::with('items.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $pendingStockOrders = StockOrder::whereIn('status', ['draft', 'ordered'])
            ->with('supplier')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'totalCategories',
            'totalSuppliers',
            'recentTransactions',
            'pendingStockOrders'
        ));
    }
}