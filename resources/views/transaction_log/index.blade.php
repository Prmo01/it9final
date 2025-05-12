<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Log') }}
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
        <title>Transaction Log</title>
        <style>
            .custom-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
            }
            .custom-table thead th {
                background-color: #f8f9fa;
                padding: 12px;
                text-align: left;
                font-weight: 600;
                border-bottom: 2px solid #dee2e6;
            }
            .custom-table tbody td {
                padding: 12px;
                border-bottom: 1px solid #dee2e6;
            }
            .custom-table tbody tr:hover {
                background-color: #f8f9fa;
            }
            .custom-table tbody tr:last-child td {
                border-bottom: none;
            }
            .search-filter-container {
                display: flex;
                gap: 10px;
                align-items: center;
                margin-bottom: 20px;
            }
            .modal-body {
                max-height: 400px;
                overflow-y: auto;
            }
        </style>
    </head>
    <body>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif
    
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium">Recent Transactions</h3>
                            <div class="flex gap-2">
                                <input type="text" placeholder="Search..." class="px-3 py-1 border rounded">
                                <select class="px-3 py-1 border rounded">
                                    <option>All Payment Methods</option>
                                    <option>Cash</option>
                                    <option>Card</option>
                                    <option>Digital Wallet</option>
                                </select>
                            </div>
                        </div>
    
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-3 border-b">Transaction ID</th>
                                    <th class="p-3 border-b">Total</th>
                                    <th class="p-3 border-b">Payment Method</th>
                                    <th class="p-3 border-b">Date</th>
                                    <th class="p-3 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border-b">{{ $transaction->transaction_id }}</td>
                                    <td class="p-3 border-b">₱{{ number_format($transaction->total, 2) }}</td>
                                    <td class="p-3 border-b">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            {{ $transaction->payment_method === 'cash' ? 'bg-green-100 text-green-800' : 
                                               ($transaction->payment_method === 'card' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ ucfirst($transaction->payment_method) }}
                                        </span>
                                    </td>
                                    <td class="p-3 border-b">{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="p-3 border-b">
                                        <button class="text-blue-600 hover:text-blue-800" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#transactionModal{{ $transaction->transaction_id }}">
                                            <i class="bi bi-eye-fill"></i> View
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                        <div class="mt-4">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Transaction Detail Modals -->
        @foreach($transactions as $transaction)
        <div class="modal fade" id="transactionModal{{ $transaction->transaction_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Transaction #{{ $transaction->transaction_id }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p><strong>Date:</strong> {{ $transaction->created_at->format('F j, Y g:i A') }}</p>
                                <p><strong>Payment Method:</strong> 
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        {{ $transaction->payment_method === 'cash' ? 'bg-green-100 text-green-800' : 
                                           ($transaction->payment_method === 'card' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($transaction->payment_method) }}
                                    </span>
                                </p>
                            </div>
                            <div class="text-right">
                                <p><strong>Subtotal:</strong> ₱{{ number_format($transaction->total - $transaction->total_with_tax + $transaction->discount, 2) }}</p>
                                <p><strong>Discount:</strong> -₱{{ number_format($transaction->discount, 2) }}</p>
                                <p><strong>Tax:</strong> ₱{{ number_format($transaction->total_with_tax - $transaction->total, 2) }}</p>
                                <h5 class="mt-2">Total: ₱{{ number_format($transaction->total_with_tax, 2) }}</h5>
                            </div>
                        </div>
    
                        <h6 class="font-medium mb-3">Items Purchased</h6>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="p-2 border text-left">Product</th>
                                        <th class="p-2 border text-right">Price</th>
                                        <th class="p-2 border text-right">Qty</th>
                                        <th class="p-2 border text-right">Discount</th>
                                        <th class="p-2 border text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaction->items as $item)
                                    <tr>
                                        <td class="p-2 border">{{ $item->product->name ?? 'Deleted Product' }}</td>
                                        <td class="p-2 border text-right">₱{{ number_format($item->price, 2) }}</td>
                                        <td class="p-2 border text-right">{{ $item->quantity }}</td>
                                        <td class="p-2 border text-right">-₱{{ number_format($item->discount, 2) }}</td>
                                        <td class="p-2 border text-right">
                                            ₱{{ number_format(($item->price * $item->quantity) - $item->discount, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-receipt"></i> Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    
        <!-- Required Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </x-app-layout>