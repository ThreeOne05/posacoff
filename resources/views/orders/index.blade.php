@extends('layouts.app')

@section('title', 'POS')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Product List -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Menu</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-md-12 mb-4">
                            <h6 class="text-muted">{{ $category->name }}</h6>
                            <div class="row">
                                @foreach($category->products as $product)
                                <div class="col-md-4 mb-3">
                                    <div class="card product-item" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $product->name }}</h6>
                                            <p class="text-muted small mb-1">{{ $product->category->name }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                <button class="btn btn-sm btn-primary add-to-cart">
                                                    <i class="bi bi-cart-plus"></i> Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 1rem;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order #{{ str_pad($orderNumber, 3, '0', STR_PAD_LEFT) }}</h5>
                </div>
                <div class="card-body">
                    <div class="order-items mb-3">
                        <div class="list-group" id="cart-items">
                            <!-- Cart items akan muncul disini -->
                        </div>
                    </div>
                    
                    <div class="totals mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pajak (10%):</span>
                            <span id="tax">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span id="total">Rp 0</span>
                        </div>
                    </div>
                    
                    <button class="btn btn-success w-100" id="complete-order" disabled>
                        <i class="bi bi-check-circle"></i> Selesaikan Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalEl = document.getElementById('subtotal');
    const taxEl = document.getElementById('tax');
    const totalEl = document.getElementById('total');
    const completeOrderBtn = document.getElementById('complete-order');

    function formatRupiah(value) {
        return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let subtotal = 0;

        cart.forEach((item, index) => {
            subtotal += item.price * item.quantity;
            const itemEl = document.createElement('div');
            itemEl.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
            itemEl.innerHTML = `
                <div>
                    <strong>${item.name}</strong> <br />
                    <small>Harga: ${formatRupiah(item.price)} x ${item.quantity}</small>
                </div>
                <div>
                    <button class="btn btn-sm btn-secondary btn-decrease" data-index="${index}"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-sm btn-secondary btn-increase" data-index="${index}"><i class="bi bi-plus"></i></button>
                    <button class="btn btn-sm btn-danger btn-remove" data-index="${index}"><i class="bi bi-trash"></i></button>
                </div>
            `;
            cartItemsContainer.appendChild(itemEl);
        });

        const tax = Math.floor(subtotal * 0.1);
        const total = subtotal + tax;

        subtotalEl.textContent = formatRupiah(subtotal);
        taxEl.textContent = formatRupiah(tax);
        totalEl.textContent = formatRupiah(total);

        completeOrderBtn.disabled = cart.length === 0;
    }

    function addToCart(product) {
        const index = cart.findIndex(item => item.id === product.id);
        if (index !== -1) {
            cart[index].quantity++;
        } else {
            cart.push({...product, quantity: 1});
        }
        updateCart();
    }

    function decreaseQuantity(index) {
        if (cart[index].quantity > 1) {
            cart[index].quantity--;
        } else {
            cart.splice(index, 1);
        }
        updateCart();
    }

    function increaseQuantity(index) {
        cart[index].quantity++;
        updateCart();
    }

    function removeItem(index) {
        cart.splice(index, 1);
        updateCart();
    }

    cartItemsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.btn-decrease')) {
            const idx = e.target.closest('.btn-decrease').dataset.index;
            decreaseQuantity(idx);
        }
        if (e.target.closest('.btn-increase')) {
            const idx = e.target.closest('.btn-increase').dataset.index;
            increaseQuantity(idx);
        }
        if (e.target.closest('.btn-remove')) {
            const idx = e.target.closest('.btn-remove').dataset.index;
            removeItem(idx);
        }
    });

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (e) => {
            const card = e.target.closest('.product-item');
            const product = {
                id: parseInt(card.dataset.id),
                name: card.dataset.name,
                price: parseInt(card.dataset.price)
            };
            addToCart(product);
        });
    });

    completeOrderBtn.addEventListener('click', () => {
        if (cart.length === 0) return alert('Keranjang kosong!');

        // Kirim data order ke backend (via fetch API atau form submission)
        // Contoh fetch POST (ubah URL sesuai route backend)
        fetch('{{ route("orders.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                items: cart
            })
        }).then(res => res.json())
          .then(data => {
              if (data.success) {
                  alert('Order berhasil disimpan!');
                  window.location.reload();
              } else {
                  alert('Gagal menyimpan order.');
              }
          }).catch(() => {
              alert('Terjadi kesalahan saat menyimpan order.');
          });
    });

    updateCart();
});
</script>
@endpush
@endsection
