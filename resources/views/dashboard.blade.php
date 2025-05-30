@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<style>
    .stat-card {
        border-radius: 1.3rem;
        box-shadow: 0 4px 18px rgba(0,0,0,0.12);
        position: relative;
        overflow: hidden;
        transition: transform 0.17s;
        background: #fff;
        min-width: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 8px 32px rgba(0,0,0,0.17);
        z-index: 2;
    }
    .stat-icon {
        position: absolute;
        right: 18px;
        top: 16px;
        font-size: 2.8rem;
        opacity: 0.13;
        pointer-events: none;
    }
    .stat-label {
        font-size: 1.09rem;
        font-weight: 600;
        letter-spacing: .02em;
        margin-bottom: 0;
        position: relative;
        z-index: 2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .stat-value {
        font-size: clamp(1.1rem, 6vw, 2.8rem);
        font-weight: bold;
        margin: 0;
        line-height: 1.1;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 8px rgba(0,0,0,0.04);
        word-break: break-word;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        min-width: 0;
        max-width: 100%;
        transition: font-size 0.18s;
        font-family: 'Fira Mono', 'Menlo', 'Consolas', monospace;
        display: block;
    }
    /* Card Gradients */
    .stat-bg-primary {
        background: linear-gradient(120deg, #2563eb 60%, #4f8cff 100%);
        color: #fff;
    }
    .stat-bg-success {
        background: linear-gradient(120deg, #16a34a 70%, #43e97b 100%);
        color: #fff;
    }
    .stat-bg-info {
        background: linear-gradient(120deg, #0284c7 60%, #38bdf8 100%);
        color: #fff;
    }
    .stat-bg-warning {
        background: linear-gradient(120deg, #fbbf24 60%, #fde68a 100%);
        color: #805b00;
    }
    /* Table Card */
    .table-card {
        border-radius: 1.2rem;
        box-shadow: 0 4px 18px rgba(0,0,0,0.10);
        overflow: hidden;
    }
    .table-card .card-header {
        background: linear-gradient(90deg, #0d6efd 60%, #38bdf8 100%);
        color: #fff;
        font-weight: bold;
        font-size: 1.18rem;
        letter-spacing: .04em;
        border-bottom: none;
    }
    .table-responsive::-webkit-scrollbar {
        height: 7px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #e0e7ef;
        border-radius: 6px;
    }
    .table-hover tbody tr:hover {
        background: #f1f5f9;
        transition: background 0.13s;
    }
    .table thead th {
        background: #f8fafc;
        font-weight: 700;
        letter-spacing: .02em;
    }
    .badge-penjualan {
        background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%);
        color: #fff;
        font-weight: 600;
        padding: 0.4em .8em;
        border-radius: 1em;
        font-size: .93rem;
        box-shadow: 0 2px 6px rgba(13,110,253,0.09);
    }
    /* Responsive Fix */
    @media (max-width: 1200px) {
        .stat-value {
            font-size: clamp(1rem, 4vw, 2.1rem);
        }
    }
    @media (max-width: 991px) {
        .stat-value {
            font-size: clamp(0.9rem, 3vw, 1.6rem);
        }
        .stat-label {
            font-size: 1rem;
        }
    }
    @media (max-width: 767px) {
        .stat-value {
            font-size: clamp(.8rem, 6vw, 1.25rem);
        }
        .stat-icon { font-size: 1.5rem; right: 7px; top: 7px; }
        .stat-label { font-size: 0.97rem; }
        .row.g-4 > [class^="col-"] {
            margin-bottom: 12px !important;
        }
    }
    @media (max-width: 540px) {
        .stat-label { font-size: 0.92rem; }
        .stat-value { font-size: clamp(.76rem, 8vw, 1.05rem); }
        .stat-card {
            padding: 0.8rem !important;
        }
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-primary" style="font-weight: bold; letter-spacing: .04em;">
        <i class="bi bi-graph-up-arrow"></i> Dashboard
    </h1>
</div>

<div class="row g-4 mb-3">
    <div class="col-12 col-sm-6 col-md-3 d-flex">
        <div class="stat-card stat-bg-primary py-4 px-4 position-relative mb-2 flex-fill d-flex flex-column align-items-start">
            <div class="stat-label mb-2"><i class="bi bi-menu-up me-1"></i> Total Menu</div>
            <div class="stat-value">{{ $stats['total_products'] }}</div>
            <i class="bi bi-menu-up stat-icon"></i>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 d-flex">
        <div class="stat-card stat-bg-success py-4 px-4 position-relative mb-2 flex-fill d-flex flex-column align-items-start">
            <div class="stat-label mb-2"><i class="bi bi-currency-dollar me-1"></i> Pendapatan Hari Ini</div>
            <div class="stat-value">
                Rp {{ number_format($stats['today_income'], 0, ',', '.') }}
            </div>
            <i class="bi bi-cash-coin stat-icon"></i>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 d-flex">
        <div class="stat-card stat-bg-info py-4 px-4 position-relative mb-2 flex-fill d-flex flex-column align-items-start">
            <div class="stat-label mb-2"><i class="bi bi-receipt me-1"></i> Order Hari Ini</div>
            <div class="stat-value">{{ $stats['today_orders'] }}</div>
            <i class="bi bi-receipt stat-icon"></i>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 d-flex">
        <div class="stat-card stat-bg-warning py-4 px-4 position-relative mb-2 flex-fill d-flex flex-column align-items-start">
            <div class="stat-label mb-2"><i class="bi bi-people me-1"></i> Total Kasir</div>
            <div class="stat-value">{{ $stats['total_cashiers'] }}</div>
            <i class="bi bi-people stat-icon"></i>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card table-card">
            <div class="card-header d-flex align-items-center">
                <i class="bi bi-person-badge me-2"></i>
                <span>Daftar Kasir</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashiers as $index => $cashier)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold">
                                        <i class="bi bi-person-circle text-primary me-1"></i>
                                        {{ $cashier->name }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $cashier->email }}</td>
                                <td>
                                    <span class="badge badge-penjualan">
                                        <i class="bi bi-bag-check-fill me-1"></i>
                                        {{ $cashier->orders_count }} Penjualan
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($cashiers) === 0)
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-emoji-frown display-5"></i><br>
                                    Data kasir belum tersedia.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection