<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <title>Suppliers</title>
        <style>
            /* public/css/dashboard.css */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.header {
    font-size: 1.75rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

/* Summary Cards */
.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.card .icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 15px;
}

.card .icon svg {
    width: 24px;
    height: 24px;
}

.card.products .icon { background: #e3f2fd; color: #1e88e5; }
.card.categories .icon { background: #e8f5e9; color: #43a047; }
.card.suppliers .icon { background: #f3e5f5; color: #8e24aa; }
.card.low-stock .icon { background: #ffebee; color: #e53935; }

.card h3 {
    font-size: 1rem;
    color: #666;
    margin: 0 0 10px;
}

.card p {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin: 0;
}

.card.low-stock p {
    color: #e53935;
}

/* Tables */
.table-container {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.table-container h3 {
    font-size: 1.25rem;
    color: #333;
    padding: 20px;
    margin: 0;
    border-bottom: 1px solid #eee;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table thead {
    background: #f9fafb;
}

table th {
    font-size: 0.85rem;
    color: #666;
    text-transform: uppercase;
    text-align: left;
    padding: 15px;
}

table tbody tr {
    transition: background 0.2s ease;
}

table tbody tr:hover {
    background: #f9fafb;
}

table td {
    font-size: 0.9rem;
    color: #333;
    padding: 15px;
    border-bottom: 1px solid #eee;
}

table td.low-stock-zero {
    color: #e53935;
    font-weight: bold;
}

table td.low-stock-low {
    color: #f57c00;
    font-weight: bold;
}

.badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 12px;
}

.badge.cash { background: #e8f5e9; color: #43a047; }
 badge.card { background: #e3f2fd; color: #1e88e5; }
.badge.draft { background: #fff3e0; color: #f57c00; }
.badge.ordered { background: #e3f2fd; color: #1e88e5; }

.empty-state {
    text-align: center;
    padding: 20px;
    color: #666;
    font-size: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-grid {
        grid-template-columns: 1fr;
    }

    .container {
        padding: 15px;
    }

    table th, table td {
        padding: 10px;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .header {
        font-size: 1.5rem;
    }

    .card h3 {
        font-size: 0.9rem;
    }

    .card p {
        font-size: 1.25rem;
    }
}
        </style>

    <div class="container">
        <!-- Include Custom CSS -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

        <!-- Summary Cards -->
        <div class="card-grid">
            <!-- Total Products -->
            <div class="card products">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3>Total Products</h3>
                <p>{{ $totalProducts }}</p>
            </div>
            <!-- Total Categories -->
            <div class="card categories">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3>Total Categories</h3>
                <p>{{ $totalCategories }}</p>
            </div>
            <!-- Total Suppliers -->
            <div class="card suppliers">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3>Total Suppliers</h3>
                <p>{{ $totalSuppliers }}</p>
            </div>
            <!-- Low Stock Alerts -->
            <div class="card low-stock">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3>Low Stock Alerts</h3>
                <p>{{ $lowStockProducts->count() }}</p>
            </div>
        </div>

        <!-- Low Stock Products Table -->
        @if($lowStockProducts->count() > 0)
            <div class="table-container">
                <h3>Low Stock Products</h3>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                                    <td class="{{ $product->quantity == 0 ? 'low-stock-zero' : 'low-stock-low' }}">
                                        {{ $product->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="table-container">
                <div class="empty-state">No low stock products at the moment.</div>
            </div>
        @endif

        <!-- Recent Transactions -->
        <div class="table-container">
            <h3>Recent Transactions</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Total</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>₱{{ number_format($transaction->total_with_tax, 2) }}</td>
                                <td>
                                    <span class="badge {{ $transaction->payment_method }}">{{ ucfirst($transaction->payment_method) }}</span>
                                </td>
                                <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Stock Orders -->
        <div class="table-container">
            <h3>Pending Stock Orders</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingStockOrders as $order)
                            <tr>
                                <td>{{ $order->reference_number }}</td>
                                <td>{{ $order->supplier->name }}</td>
                                <td>
                                    <span class="badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>