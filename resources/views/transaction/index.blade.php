<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Point of Sale</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #0b6599;
                --primary-dark: #0b6599;
                --secondary: #6b7280;
                --success: #10b981;
                --danger: #ef4444;
                --light: #f9fafb;
                --dark: #1f2937;
                --border-radius: 0.5rem;
                --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                --transition: all 0.3s ease;
            }

            body {
                background-color: var(--light);
                font-family: 'Inter', sans-serif;
                color: var(--dark);
            }

            .pos-container {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 1.5rem;
                margin: 2rem auto;
                max-width: 1400px;
                padding: 0 1rem;
            }

            .card {
                background: white;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                transition: var(--transition);
                overflow: hidden;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            }

            .card-header {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                padding: 1rem 1.5rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                border-bottom: none;
            }

            .card-header i {
                font-size: 1.2rem;
            }

            .search-container {
                position: relative;
                margin: 1rem 0;
            }

            .search-container input {
                padding: 0.75rem 3rem 0.75rem 1.5rem;
                border: 1px solid #d1d5db;
                border-radius: var(--border-radius);
                font-size: 0.95rem;
                transition: var(--transition);
                width: 100%;
            }

            .search-container input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
                outline: none;
            }

            .search-container button {
                position: absolute;
                right: 0.5rem;
                top: 50%;
                transform: translateY(-50%);
                padding: 0.5rem 1rem;
                background: var(--primary);
                border: none;
                border-radius: 0.25rem;
                color: white;
                font-weight: 500;
                transition: var(--transition);
            }

            .search-container button:hover {
                background: var(--primary-dark);
            }

            .product-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 1rem;
                padding: 1rem;
                max-height: 300px;
                overflow-y: auto;
            }

            .product-card {
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: var(--border-radius);
                padding: 1rem;
                text-align: center;
                transition: var(--transition);
                cursor: pointer;
            }

            .product-card:hover {
                border-color: var(--primary);
                box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
                transform: translateY(-2px);
            }

            .product-card h6 {
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--dark);
                margin-bottom: 0.5rem;
            }

            .product-card p {
                font-size: 0.85rem;
                color: var(--secondary);
                margin: 0;
            }

            .empty-products {
                padding: 2rem;
                text-align: center;
                color: var(--secondary);
            }

            .empty-products i {
                font-size: 2.5rem;
                color: #d1d5db;
                margin-bottom: 1rem;
            }

            .empty-products h6 {
                font-weight: 600;
                color: var(--dark);
                margin-bottom: 0.5rem;
            }

            .empty-products p {
                font-size: 0.9rem;
            }

            .cart-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .cart-table thead th {
                background: #f1f5f9;
                padding: 1rem 1.5rem;
                font-weight: 600;
                color: var(--secondary);
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.05rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .cart-table tbody tr {
                transition: var(--transition);
            }

            .cart-table tbody tr:hover {
                background: #f9fafb;
            }

            .cart-table tbody td {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #e5e7eb;
                vertical-align: middle;
                font-size: 0.95rem;
            }

            .cart-table tbody tr:last-child td {
                border-bottom: none;
            }

            .qty-input {
                width: 80px;
                padding: 0.5rem;
                border: 1px solid #d1d5db;
                border-radius: 0.25rem;
                font-weight: 500;
                text-align: center;
                transition: var(--transition);
            }

            .qty-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
                outline: none;
            }

            .btn-action {
                width: 32px;
                height: 32px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 0.25rem;
                background: var(--danger);
                color: white;
                transition: var(--transition);
            }

            .btn-action:hover {
                background: #dc2626;
                transform: translateY(-1px);
            }

            .empty-cart {
                padding: 2rem;
                text-align: center;
            }

            .empty-cart i {
                font-size: 3rem;
                color: #d1d5db;
                margin-bottom: 1rem;
            }

            .empty-cart h5 {
                font-weight: 600;
                color: var(--dark);
                margin-bottom: 0.5rem;
            }

            .empty-cart p {
                color: var(--secondary);
                font-size: 0.9rem;
            }

            .summary-item {
                display: flex;
                justify-content: space-between;
                padding: 0.75rem 0;
                font-size: 0.95rem;
                border-bottom: 1px dashed #e5e7eb;
            }

            .summary-total {
                display: flex;
                justify-content: space-between;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--dark);
                padding: 1rem 0;
            }

            .payment-input, .form-control {
                padding: 0.75rem 1rem;
                border: 1px solid #d1d5db;
                border-radius: var(--border-radius);
                font-size: 0.95rem;
                transition: var(--transition);
            }

            .payment-input:focus, .form-control:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
                outline: none;
            }

            .btn-checkout {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                font-weight: 600;
                padding: 0.75rem;
                border-radius: var(--border-radius);
                border: none;
                width: 100%;
                font-size: 1rem;
                transition: var(--transition);
            }

            .btn-checkout:hover {
                background: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            }

            .alert-dismissible {
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
            }

            @media (max-width: 992px) {
                .pos-container {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 576px) {
                .card-header {
                    padding: 0.75rem 1rem;
                    font-size: 0.95rem;
                }

                .cart-table thead th,
                .cart-table tbody td {
                    padding: 0.75rem;
                    font-size: 0.85rem;
                }

                .qty-input {
                    width: 60px;
                }

                .product-grid {
                    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
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
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
    
                <div class="pos-container">
                    <!-- Left Column - Products & Cart -->
                    <div class="left-column">
                        <!-- Product Search and Selection -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="bi bi-upc-scan"></i>
                                <span>Scan or Select Products</span>
                            </div>
                            <div class="card-body">
                                <!-- Search Form -->
                                <form action="{{ route('transaction.add') }}" method="POST" id="search-form">
                                    @csrf
                                    <div class="search-container">
                                        <input type="text" name="product_code" id="product-search" class="form-control" placeholder="Scan barcode or search products..." autofocus>
                                        <button type="submit">
                                            <i class="bi bi-plus-lg me-1"></i> Add
                                        </button>
                                    </div>
                                </form>
    
                                <!-- Product Grid -->
                                <div class="product-grid" id="product-grid">
                                    @foreach($products as $product)
                                        <div class="product-card" data-product-id="{{ $product->product_id }}" data-product-name="{{ $product->name }}" data-product-barcode="{{ $product->barcode }}">
                                            <h6>{{ $product->name }}</h6>
                                            <p>₱{{ number_format($product->sell_price, 2) }}</p>
                                        </div>
                                    @endforeach
                                </div>
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
                                    <table class="cart-table">
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
                                    <span>Subtotal</span>
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
    
            <!-- Transaction Receipt Modal -->
            @if(session('showReceiptModal') && session('transaction'))
                <div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Transaction #{{ session('transaction')->transaction_id }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p><strong>Date:</strong> {{ session('transaction')->created_at->format('F j, Y g:i A') }}</p>
                                        <p><strong>Payment Method:</strong>
                                            <span class="px-2 py-1 rounded-full text-xs
                                                {{ session('transaction')->payment_method === 'cash' ? 'bg-green-100 text-green-800' :
                                                   (session('transaction')->payment_method === 'card' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                                {{ ucfirst(session('transaction')->payment_method) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p><strong>Subtotal:</strong> ₱{{ number_format(session('transaction')->total, 2) }}</p>
                                        <p><strong>Discount:</strong> -₱{{ number_format(session('transaction')->discount, 2) }}</p>
                                        <p><strong>Tax (12%):</strong> ₱{{ number_format(session('transaction')->total_with_tax - session('transaction')->total, 2) }}</p>
                                        <h5 class="mt-2">Total: ₱{{ number_format(session('transaction')->total_with_tax, 2) }}</h5>
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
                                            @forelse(session('transaction')->items as $item)
                                                <tr>
                                                    <td class="p-2 border">{{ $item->product->name ?? 'Deleted Product' }}</td>
                                                    <td class="p-2 border text-right">₱{{ number_format($item->price, 2) }}</td>
                                                    <td class="p-2 border text-right">{{ $item->quantity }}</td>
                                                    <td class="p-2 border text-right">-₱{{ number_format($item->discount, 2) }}</td>
                                                    <td class="p-2 border text-right">
                                                        ₱{{ number_format(($item->price * $item->quantity) - $item->discount, 2) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="p-2 border text-center">No items found for this transaction.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary print-receipt">
                                    <i class="bi bi-receipt"></i> Print Receipt
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    
            <!-- JavaScript for dynamic updates and product filtering -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const quantityInputs = document.querySelectorAll('.qty-input');
                    const discountInput = document.querySelector('#discount');
                    const searchInput = document.querySelector('#product-search');
                    const productGrid = document.querySelector('#product-grid');
                    const productCards = productGrid.querySelectorAll('.product-card');
    
                    // Update cart totals
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
    
                    // Quantity update
                    quantityInputs.forEach(function(input) {
                        input.addEventListener('change', function() {
                            const form = input.closest('form');
                            const row = input.closest('tr');
                            const quantity = parseInt(input.value);
                            const price = parseFloat(row.querySelector('.item-price').innerText);
                            const totalCell = row.querySelector('.item-total');
    
                            const total = price * quantity;
                            totalCell.innerText = total.toFixed(2);
    
                            updateTotal();
    
                            // Auto-submit quantity update form
                            fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                }
                            });
                        });
                    });
    
                    // Discount update
                    discountInput.addEventListener('input', function() {
                        updateTotal();
                    });
    
                    // Product search filter
                    searchInput.addEventListener('input', function() {
                        const query = searchInput.value.toLowerCase();
                        productCards.forEach(function(card) {
                            const name = card.dataset.productName.toLowerCase();
                            const barcode = card.dataset.productBarcode.toLowerCase();
                            card.style.display = (name.includes(query) || barcode.includes(query)) ? '' : 'none';
                        });
                    });
    
                    // Add product to cart on click
                    productCards.forEach(function(card) {
                        card.addEventListener('click', function() {
                            const productId = card.dataset.productId;
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '{{ route("transaction.add") }}';
    
                            const csrf = document.createElement('input');
                            csrf.type = 'hidden';
                            csrf.name = '_token';
                            csrf.value = document.querySelector('meta[name="csrf-token"]')?.content;
    
                            const productCode = document.createElement('input');
                            productCode.type = 'hidden';
                            productCode.name = 'product_code';
                            productCode.value = productId;
    
                            form.appendChild(csrf);
                            form.appendChild(productCode);
                            document.body.appendChild(form);
                            form.submit();
                        });
                    });
    
                    // Automatically show receipt modal if flag is set
                    @if(session('showReceiptModal'))
                        const receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'));
                        receiptModal.show();
                    @endif
    
                    // Print receipt functionality
                    document.querySelector('.print-receipt')?.addEventListener('click', function() {
                        const modalContent = document.querySelector('#receiptModal .modal-content').cloneNode(true);
                        const printWindow = window.open('', '_blank');
                        printWindow.document.write(`
                            <html>
                                <head>
                                    <title>Invoice</title>
                                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                                    <style>
                                        body { font-family: Arial, sans-serif; padding: 20px; }
                                        .modal-header, .modal-footer { display: none; }
                                        .modal-body { padding: 20px; }
                                        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
                                        table { width: 100%; border-collapse: collapse; }
                                        th, td { border: 1px solid #dee2e6; padding: 8px; }
                                        th { background-color: #f8f9fa; }
                                        .text-right { text-align: right; }
                                        @media print {
                                            .no-print { display: none; }
                                        }
                                    </style>
                                </head>
                                <body>
                                    ${modalContent.outerHTML}
                                </body>
                            </html>
                        `);
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                    });
                });
            </script>
        </body>
    </html>
</x-app-layout>