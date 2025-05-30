@extends('layouts.app')

@section('title', 'POS')

@section('content')
<style>
main.container {
    background: transparent !important;
    box-shadow: none !important;
    padding: 0 !important;
    margin: 2vw auto !important;
    min-width: 0 !important;
    min-height: 0 !important;
    border-radius: 0 !important;
    width: 150vw !important; /* Menggunakan viewport width untuk responsif */
    max-width: 60vw !important; /* Batas maksimal lebar */
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}

.main-bg-card {
    background: #fff;
    border-radius: 2.7rem;
    box-shadow: 0 8px 40px 0 rgba(0,0,0,0.07);
    padding: 2.5rem 2.2rem 2.2rem 2.2rem;
    min-height: 74vh;
    width: 100%;
    margin: 0 auto;
    display: block;
    transition: all 0.3s ease;
}

/* Dark Mode Styling */
@media (prefers-color-scheme: dark) {
    body {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%) !important;
        color: #e4e4e7 !important;
    }
    
    .main-bg-card {
        background: linear-gradient(145deg, #1e1e2e 0%, #252538 100%) !important;
        box-shadow: 0 20px 60px 0 rgba(0,0,0,0.4), 
                    inset 0 1px 0 rgba(255,255,255,0.1) !important;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .border-bottom {
        border-color: rgba(255,255,255,0.1) !important;
    }
    
    .text-primary {
        color: #60a5fa !important;
    }
    
    .text-dark {
        color: #e4e4e7 !important;
    }
    
    .text-muted {
        color: #a1a1aa !important;
    }
}

.product-card {
    width: 260px;   /* Ubah sesuai keinginan, misal 150px/200px */
    height: 270px;  /* Ubah sesuai keinginan, misal 250px/300px */
    border-radius: 1.1rem;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    transition: all 0.3s ease;
    border: none;
    display: flex;
    flex-direction: column;
    background: #fff;
}

/* Dark Mode Product Card */
@media (prefers-color-scheme: dark) {
    .product-card {
        background: linear-gradient(145deg, #2d2d3a 0%, #3a3a4f 100%) !important;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3), 
                    0 2px 8px rgba(0,0,0,0.2),
                    inset 0 1px 0 rgba(255,255,255,0.1) !important;
        border: 1px solid rgba(255,255,255,0.1);
        color: #e4e4e7 !important;
    }
    
    .product-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 16px 48px rgba(0,0,0,0.4), 
                    0 4px 16px rgba(96,165,250,0.2),
                    inset 0 1px 0 rgba(255,255,255,0.15) !important;
    }
    
    .product-card .card-title {
        color: #f1f5f9 !important;
    }
    
    .product-card .text-muted {
        color: #94a3b8 !important;
    }
}

.product-card img {
    object-fit: cover;
    width: 100%;
    height: 100px;  /* Sesuaikan agar proporsional */
    border-radius: 1rem 1rem 0 0;
}

.product-card .card-body {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    padding: 1rem 1.1rem 0.9rem 1.1rem !important;
    overflow: hidden;
}

.category-dropdown .dropdown-toggle {
    background: linear-gradient(90deg, #0d6efd 40%, #43c6ac 100%);
    border: none;
    color: #fff;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Dark Mode Dropdown */
@media (prefers-color-scheme: dark) {
    .category-dropdown .dropdown-toggle {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
        box-shadow: 0 4px 16px rgba(79,70,229,0.3);
    }
    
    .category-dropdown .dropdown-toggle:hover {
        background: linear-gradient(135deg, #6366f1 0%, #0891b2 100%) !important;
        box-shadow: 0 8px 24px rgba(79,70,229,0.4);
    }
    
    .dropdown-menu {
        background: linear-gradient(145deg, #2d2d3a 0%, #3a3a4f 100%) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        box-shadow: 0 16px 48px rgba(0,0,0,0.4) !important;
    }
    
    .dropdown-item {
        color: #e4e4e7 !important;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover {
        background: linear-gradient(90deg, rgba(79,70,229,0.2) 0%, rgba(6,182,212,0.2) 100%) !important;
        color: #f1f5f9 !important;
    }
}

.btn-gradient-primary {
    background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%);
    border: none;
    color: #fff;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient-primary:hover {
    background: linear-gradient(90deg, #43c6ac 0%, #0d6efd 100%);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(13,110,253,0.3);
}

/* Dark Mode Primary Button */
@media (prefers-color-scheme: dark) {
    .btn-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
        box-shadow: 0 4px 16px rgba(79,70,229,0.3);
    }
    
    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #6366f1 0%, #0891b2 100%) !important;
        box-shadow: 0 8px 24px rgba(79,70,229,0.4);
        transform: translateY(-3px);
    }
}

.badge-price {
    background: linear-gradient(90deg, #0d6efd 40%, #43c6ac 100%);
    color: #fff;
    font-size: 0.93rem;
}

/* Dark Mode Badge */
@media (prefers-color-scheme: dark) {
    .badge-price {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
    }
}

.offcanvas-header {
    margin-top: 75px;
    background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%) !important;
}

/* Dark Mode Offcanvas */
@media (prefers-color-scheme: dark) {
    .offcanvas-header {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
        box-shadow: 0 4px 16px rgba(79,70,229,0.3);
    }
    
    .offcanvas {
        background: linear-gradient(145deg, #1e1e2e 0%, #252538 100%) !important;
        border-left: 1px solid rgba(255,255,255,0.1);
    }
    
    .offcanvas-body {
        background: transparent;
    }
    
    .list-group-item {
        background: linear-gradient(145deg, #2d2d3a 0%, #3a3a4f 100%) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: #e4e4e7 !important;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem !important;
    }
    
    .fw-semibold {
        color: #f1f5f9 !important;
    }
    
    .text-success {
        color: #22c55e !important;
    }
}

.badge-cart {
    background: #dc3545;
    font-size: 0.85em;
    position: absolute;
    top: 3px;
    left: 6px;
    z-index: 2;
}

.btn-cart-toggle {
    position: relative;
    transition: all 0.3s ease;
}

/* Dark Mode Cart Button */
@media (prefers-color-scheme: dark) {
    .btn-outline-success {
        border-color: #22c55e !important;
        color: #22c55e !important;
        background: rgba(34,197,94,0.1) !important;
    }
    
    .btn-outline-success:hover {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
        border-color: #22c55e !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(34,197,94,0.3);
    }
}

/* Responsive grid improvements */
@media (max-width: 991.98px) {
    .row.g-3.p-2 > [class^="col-"] {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767.98px) {
    .row.g-3.p-2 > [class^="col-"] {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .product-card img {
        height: 110px;
    }
    .product-card h6 {
        font-size: 1rem;
    }
    .product-card small {
        font-size: 0.86rem;
    }
    .product-card .card-body {
        padding: 1rem !important;
    }
    .btn, .dropdown-toggle, .btn-group .btn {
        font-size: 0.95rem !important;
        padding: 8px 13px !important;
    }
    .offcanvas {
        width: 97vw !important;
    }
    .btn-cart-toggle .badge-cart {
        top: 2px;
        right: 2px;
    }
}

@media (max-width: 400px) {
    .product-card img {
        height: 80px;
    }
    .product-card .card-body {
        padding: .75rem !important;
    }
    h2 {
        font-size: 1rem;
    }
}

/* Sticky cart button for mobile */
.cart-sticky-btn {
    display: none;
}

@media (max-width: 767.98px) {
    .cart-sticky-btn {
        display: flex !important;
        position: fixed;
        z-index: 2020;
        right: 18px;
        bottom: 18px;
        border-radius: 50%;
        box-shadow: 0 7px 24px #0d6efd22;
        background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%);
        color: #fff;
        width: 56px;
        height: 56px;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        border: none;
        transition: all 0.3s ease;
    }
    
    .cart-sticky-btn .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: #fff;
        font-size: .9em;
        border-radius: 2em;
        padding: .11em .55em;
        font-weight: 700;
    }
}

/* Dark Mode Sticky Button */
@media (prefers-color-scheme: dark) and (max-width: 767.98px) {
    .cart-sticky-btn {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
        box-shadow: 0 12px 32px rgba(79,70,229,0.4) !important;
    }
    
    .cart-sticky-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 16px 40px rgba(79,70,229,0.5) !important;
    }
}

/* Dark Mode Button Variants */
@media (prefers-color-scheme: dark) {
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        border: none !important;
        box-shadow: 0 2px 8px rgba(245,158,11,0.3);
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(245,158,11,0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        border: none !important;
        box-shadow: 0 2px 8px rgba(239,68,68,0.3);
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(239,68,68,0.4);
    }
    
    .btn-outline-primary {
        border-color: #60a5fa !important;
        color: #60a5fa !important;
        background: rgba(96,165,250,0.1) !important;
    }
    
    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%) !important;
        border-color: #60a5fa !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(96,165,250,0.3);
    }
    
    .btn-outline-danger {
        border-color: #f87171 !important;
        color: #f87171 !important;
        background: rgba(248,113,113,0.1) !important;
    }
    
    .btn-outline-danger:hover {
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important;
        border-color: #f87171 !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(248,113,113,0.3);
    }
}
</style>

<div class="main-bg-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center p-3 border-bottom gap-2 mb-2">
        <h2 class="mb-0 fw-semibold text-primary">
            <i class="bi bi-bag-check-fill me-2"></i>Acoff <span class="text-dark">- Daftar Menu</span>
        </h2>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            {{-- Dropdown Kategori --}}
            <div class="btn-group category-dropdown">
                <button type="button" class="btn dropdown-toggle shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(isset($category))
                        {{ ucfirst($category->name) }}
                    @else
                        Semua Kategori
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Semua Kategori</a></li>
                    @foreach ($categories as $cat)
                        <li>
                            <a class="dropdown-item" href="{{ route('products.category', ['type' => $cat->type]) }}">
                                {{ ucfirst($cat->name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Tambah Produk --}}
            <a href="{{ route('products.create') }}" class="btn btn-gradient-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> <span class="d-none d-sm-inline">Tambah Menu</span>
            </a>

            {{-- Toggle Sidebar (desktop) --}}
            @php
                $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'qty')) : 0;
            @endphp
            <button class="btn btn-outline-success btn-cart-toggle shadow-sm position-relative d-none d-md-inline-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                <i class="bi bi-cart"></i>
                <span class="d-none d-sm-inline">Keranjang</span>
                @if($cartCount > 0)
                    <span class="badge badge-cart">{{ $cartCount }}</span>
                @endif
            </button>
        </div>
    </div>

    {{-- Sticky Cart Button Mobile --}}
    <button class="cart-sticky-btn d-md-none" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
        <i class="bi bi-cart"></i>
        @if($cartCount > 0)
            <span class="badge">{{ $cartCount }}</span>
        @endif
    </button>

    {{-- Konten Produk --}}
    <div class="row g-3 p-2 justify-content-start">
        @forelse($products as $product)
            <div class="col-auto d-flex">
                <div class="card product-card">
                    <img src="{{ asset($product->image_path ?? 'placeholder.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body p-3 d-flex flex-column">
                        <h6 class="card-title mb-1 fw-bold">{{ $product->name }}</h6>
                        <small class="text-muted d-block mb-1">{{ $product->category->name }}</small>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <span class="badge badge-price px-2 pt-2 pb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <form method="POST" action="{{ route('pos.add-item') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-circle" title="Tambah ke Keranjang">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                        <div class="btn-group w-100 mt-auto">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning w-50" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100" type="submit" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center mt-5 text-muted">Produk tidak ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

    {{-- Sidebar Pembayaran --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" style="z-index: 9999; position: fixed; top: 0; right: 0; ">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold text-white"><i class="bi bi-cart-check-fill me-2"></i>Keranjang Pembayaran</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @php $total = 0; @endphp

            @if(session('cart') && count(session('cart')) > 0)
                <ul class="list-group mb-3">
                    @foreach (session('cart') as $key => $item)
                        @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-semibold">{{ $item['name'] }}</div>
                                <small class="text-muted">Rp {{ number_format($item['price'], 0, ',', '.') }} × {{ $item['qty'] }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary rounded-pill me-2">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                                <form action="{{ route('pos.remove-item', $key) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ms-1" title="Hapus item">&times;</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5 text-success">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="d-flex gap-2 mb-2">
                    <form action="{{ route('pos.clear-cart') }}" method="POST" class="w-50">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100"><i class="bi bi-trash"></i> Hapus Semua</button>
                    </form>

                    <form method="POST" action="{{ route('pos.complete') }}" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-gradient-primary w-100 fw-bold">
                            <i class="bi bi-cash-coin me-1"></i>Bayar
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-cart-x display-4 mb-2"></i>
                    <p>Belum ada item di keranjang.</p>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- Bootstrap icon CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@endsection