@extends('layouts.app')

@section('title', 'Nota Pembayaran')

@section('content')
<style>
    @media print {
        .no-print,
        header, /* Hilangkan header dari app.blade.php saat print */
        footer, /* Hilangkan footer jika ada */
        .navbar, /* Hilangkan navbar utama saat print */
        .sidebar, /* Jika ada sidebar */
        .breadcrumb, /* Jika ada breadcrumb */
        .page-title, /* Jika ada judul halaman luar nota */
        .pagination, /* Jika ada pagination */
        .alert, /* Jika ada alert di luar nota */
        .app-header, /* Jika pakai class ini di layout */
        .app-footer
        {
            display: none !important;
        }
        body {
            margin: 0 !important;
            background: #fff !important;
        }
        #nota {
            box-shadow: none !important;
            border: none !important;
        }
        @page {
            margin: 0;
        }
        html, body {
            width: 100vw !important;
            overflow: visible !important;
        }
    }
    #nota {
        border-radius: 1.1rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.13);
        background: #fff;
        position: relative;
    }
    .nota-logo {
        width: 65px;
        height: 65px;
        object-fit: contain;
        margin-bottom: 10px;
    }
    .nota-header {
        text-align: center;
        border-bottom: 2px dashed #e2e8f0;
        padding-bottom: .7rem;
        margin-bottom: 1.1rem;
    }
    .nota-title {
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: .04em;
        color: #0d6efd;
        margin-bottom: 0.3rem;
    }
    .nota-address {
        font-size: .97rem;
        color: #6b7280;
        margin-bottom: 0.1rem;
    }
    .nota-info {
        font-size: .97rem;
        color: #333;
        margin-bottom: .2rem;
    }
    .nota-item-name {
        font-weight: 600;
        color: #0d6efd;
    }
    .nota-divider {
        border-top: 2px dashed #e2e8f0;
        margin: .8rem 0;
    }
    .nota-total {
        color: #16a34a;
        font-weight: 700;
        font-size: 1.22rem;
    }
    .nota-thankyou {
        text-align: center;
        margin-top: 1rem;
        font-size: 1.08rem;
        color: #0d6efd;
        font-weight: 500;
        letter-spacing: .03em;
    }
    @media (max-width: 575px) {
        #nota { padding: 1.2rem !important; }
        .nota-logo { width: 46px; height: 46px; }
        .nota-title { font-size: 1.18rem;}
    }
</style>

<div class="container py-4" style="max-width: 420px">
    <div id="nota" class="border p-4">
        <div class="nota-header">
            {{-- Ganti src sesuai logo kamu --}}
            <img src="{{ asset('storage/lor.png') }}" alt="Logo" class="nota-logo d-block mx-auto" style="width: 200px; height: 200px;">
            <div class="nota-title">Ammang Coffe</div>
            <div class="nota-address">Jalan Bandau Impian No.99</div>
        </div>

        <div class="nota-info"><strong>Kasir:</strong> {{ $order->user->name }}</div>
        <div class="nota-info"><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</div>
        <div class="nota-divider"></div>
        @php $total = 0; @endphp

        @foreach ($order->items as $item)
            @php
                $subtotal = $item->price * $item->quantity;
                $total += $subtotal;
            @endphp
            <div class="mb-2 pb-2 border-bottom" style="border-color:#e2e8f0!important;">
                <div class="nota-item-name">{{ $item->product->name ?? 'Produk terhapus' }}</div>
                <div class="text-muted" style="font-size:.97rem;">
                    Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}
                </div>
                <div class="fw-semibold" style="font-size:.99rem;">
                    Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                </div>
            </div>
        @endforeach

        <div class="nota-divider"></div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="nota-total">Total</span>
            <span class="nota-total">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
        <div class="nota-thankyou">
            <span>Terima Kasihh Kawann Ammang Mencintai MU</span>
        </div>
    </div>
    <div class="text-center mt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="bi bi-printer me-1"></i> Cetak Nota
        </button>
        <div class="small text-muted mt-2">
            <span class="d-block">* Hilangkan <b>Headers and footers</b> di pengaturan print untuk hasil nota bersih.</span>
        </div>
    </div>
</div>
@endsection