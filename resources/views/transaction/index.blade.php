<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Point of Sale') }}
        </h2>
    </x-slot>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>POS System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            :root {
                --primary: #4361ee;
                --primary-dark: #3a56d4;
                --secondary: #3f37c9;
                --success: #4cc9f0;
                --danger: #f72585;
                --light: #f8f9fa;
                --dark: #212529;
                --gray: #6c757d;
                --border-radius: 0.75rem;
                --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                --transition: all 0.2s ease;
            }

            body {
                background-color: #f5f7fb;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .pos-container {
                display: grid;
                grid-template-columns: 1.5fr 1fr;
                gap: 1.5rem;
                margin-top: 1rem;
            }

            .card {
                border: none;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                overflow: hidden;
                transition: var(--transition);
                background: white;
            }

            .card-header {
                background: var(--primary);
                color: white;
                font-weight: 600;
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .card-header i {
                font-size: 1.25rem;
            }

            .search-container {
                position: relative;
            }

            .search-container input {
                font-size: 1.1rem;
                padding: 1rem 1.5rem;
                border: 2px solid #e9ecef;
                border-radius: var(--border-radius);
                transition: var(--transition);
            }

            .search-container input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            }

            .search-container button {
                position: absolute;
                right: 5px;
                top: 5px;
                bottom: 5px;
                padding: 0 1.5rem;
                background: var(--primary);
                border: none;
                border-radius: calc(var(--border-radius) - 5px);
                color: white;
                font-weight: 600;
                transition: var(--transition);
            }

            .search-container button:hover {
                background: var(--primary-dark);
            }

            .cart-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .cart-table thead th {
                background: #f8fafc;
                padding: 1rem 1.5rem;
                font-weight: 600;
                color: var(--gray);
                text-transform: uppercase;
                font-size: 0.8rem;
                letter-spacing: 0.5px;
                border-bottom: 1px solid #e9ecef;
            }

            .cart-table tbody td {
                padding: 1.25rem 1.5rem;
                border-bottom: 1px solid #f1f3f5;
                vertical-align: middle;
            }

            .cart-table tbody tr:last-child td {
                border-bottom: none;
            }

            .qty-input {
                width: 70px;
                text-align: center;
                padding: 0.5rem;
                border: 1px solid #e9ecef;
                border-radius: 6px;
                font-weight: 500;
                transition: var(--transition);
            }

            .qty-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.15);
            }

            .btn-action {
                width: 36px;
                height: 36px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                transition: var(--transition);
            }

            .btn-action:hover {
                transform: translateY(-2px);
            }

            .empty-cart {
                padding: 3rem 2rem;
                text-align: center;
            }

            .empty-cart i {
                font-size: 3.5rem;
                color: #e9ecef;
                margin-bottom: 1.5rem;
            }

            .empty-cart h5 {
                color: var(--dark);
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .empty-cart p {
                color: var(--gray);
                font-size: 0.95rem;
            }

            .summary-item {
                display: flex;
                justify-content: space-between;
                padding: 0.75rem 0;
                border-bottom: 1px dashed #e9ecef;
            }

            .summary-total {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--dark);
                padding: 1rem 0;
            }

            .payment-input {
                font-size: 1.1rem;
                padding: 1rem 1.5rem;
                border: 2px solid #e9ecef;
                border-radius: var(--border-radius);
                transition: var(--transition);
            }

            .payment-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            }

            .btn-checkout {
                background: var(--primary);
                color: white;
                font-weight: 600;
                padding: 1rem;
                border-radius: var(--border-radius);
                transition: var(--transition);
                border: none;
                width: 100%;
                font-size: 1.1rem;
            }

            .btn-checkout:hover {
                background: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
            }

            @media (max-width: 992px) {
                .pos-container {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>

    <body>
        <div class="py-4">
            <div class="container">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
    
                <div class="pos-container">
                    <!-- Left Column - Products & Cart -->
                    <div class="left-column">
                        <!-- Product Search -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="bi bi-upc-scan"></i>
                                <span>Scan Products</span>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('transaction.add') }}" method="POST">
                                    @csrf
                                    <div class="search-container">
                                        <input type="text" name="product_code" class="form-control" placeholder="Scan barcode or search products..." required autofocus>
                                        <button type="submit">
                                            <i class="bi bi-plus-lg me-1"></i> Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
    
                        <!-- Shopping Cart -->
                        <div class="card">
                            <div class="card-header">
                                <i class="bi bi-cart3"></i>
                                <span>Order Items</span>
                            </div>
                            <div class="card-body p-0">
                                @if(count($cart) === 0)
                                    <div class="empty-cart">
                                        <i class="bi bi-cart-x"></i>
                                        <h5>Empty Cart</h5>
                                        <p>Your cart is currently empty, please add products to continue.</p>
                                    </div>
                                @else
                                    <table class="table cart-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="item-price">{{ number_format($item['price'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('transaction.updateQuantity', $item['id']) }}" method="POST" class="d-inline update-quantity-form">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="number" class="qty-input" name="quantity" value="{{ $item['quantity'] }}" min="1" required>
                                                
                                                </form>
                                            </td>
                                            <td class="item-total">{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('transaction.remove', $item['id']) }}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-sm"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <!-- Right Column - Summary and Payment -->
                    <div class="right-column">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="bi bi-cash-stack"></i>
                                <span>Summary</span>
                            </div>
                            <div class="card-body">
                                <div class="summary-item">
                                    <span>Total</span>
                                    <span id="total-amount">{{ number_format($total, 2) }}</span>
                                </div>
                                <div class="summary-item">
                                    <span>Tax (12%)</span>
                                    <span>{{ number_format($total * 0.12, 2) }}</span>
                                </div>
    
                                <!-- Discount Input -->
                                <div class="mb-4">
                                    <label for="discount" class="form-label">Fixed Discount (₱)</label>
                                    <input type="number" class="form-control payment-input" id="discount" name="discount" min="0" max="{{ $total }}" value="{{ old('discount', 0) }}">
                                </div>
    
                                <!-- Total with Discount -->
                                <div class="summary-total">
                                    <span>Total Amount</span>
                                    <span id="final-amount">{{ number_format(($total * 1.12) - (old('discount', 0)), 2) }}</span>
                                </div>
                            </div>
                        </div>
    
                        <!-- Payment -->
                        <form action="{{ route('transaction.complete') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-credit-card"></i>
                                    <span>Payment</span>
                                </div>
                                <div class="card-body">
                                    <!-- Payment Method Selection -->
                                    <div class="mb-4">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control" required>
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                            <option value="online">Online Payment</option>
                                        </select>
                                    </div>
    
                                    <!-- Amount Paid Input -->
                                    <div class="mb-4">
                                        <label for="payment_amount" class="form-label">Amount Paid</label>
                                        <input type="number" class="form-control payment-input" name="payment_amount" min="{{ $total }}" value="{{ old('payment_amount') }}" required>
                                    </div>
    
                                    <button type="submit" class="btn-checkout">Complete Purchase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- JavaScript for dynamic update -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const quantityInputs = document.querySelectorAll('.qty-input');
                const discountInput = document.querySelector('#discount');
                
                function updateTotal() {
                    let total = 0;
                    document.querySelectorAll('.item-total').forEach(function (totalCell) {
                        total += parseFloat(totalCell.innerText);
                    });
    
                    let discount = parseFloat(discountInput.value) || 0;
                    let finalTotal = total * 1.12 - discount;
    
                    document.querySelector('#total-amount').innerText = total.toFixed(2);
                    document.querySelector('#final-amount').innerText = finalTotal.toFixed(2);
                }
    
                quantityInputs.forEach(function(input) {
                    input.addEventListener('change', function() {
                        const row = input.closest('tr');
                        const quantity = parseInt(input.value);
                        const price = parseFloat(row.querySelector('.item-price').innerText);
                        const totalCell = row.querySelector('.item-total');
    
                        const total = price * quantity;
                        totalCell.innerText = total.toFixed(2);
    
                        updateTotal();
                    });
                });
    
                // Recalculate total when discount is changed
                discountInput.addEventListener('input', function() {
                    updateTotal();
                });
            });
        </script>
        </body>
        </html>
    </x-app-layout>