@extends('layouts.app')

@section('title', 'Daftar Kasir')

@section('content')
<style>
    .card-cashier-list {
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.11);
        background: #fff;
        padding: 2rem 1.5rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .table thead th {
        background: #f8fafc;
        font-weight: 700;
    }
    .table-hover tbody tr:hover {
        background: #e0f2fe;
        transition: background 0.15s;
    }
    .btn-gradient-primary {
        background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%);
        color: #fff;
        font-weight: bold;
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(90deg, #43c6ac 0%, #0d6efd 100%);
        color: #fff;
    }
    .icon-avatar {
        background: linear-gradient(135deg, #43c6ac 0%, #0d6efd 100%);
        color: #fff;
        font-weight: 700;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
    }
</style>
<div class="container">
    <div class="card-cashier-list">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary mb-0"><i class="bi bi-people-fill me-2"></i> Daftar Kasir</h2>
            <a href="{{ route('cashiers.create') }}" class="btn btn-gradient-primary">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Kasir
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cashiers as $cashier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="icon-avatar">
                                    {{ strtoupper(substr($cashier->name,0,1)) }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $cashier->name }}</td>
                            <td class="text-muted">{{ $cashier->email }}</td>
                            <td>
                                <a href="{{ route('cashiers.edit', $cashier->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('cashiers.destroy', $cashier->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kasir ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-emoji-frown display-5"></i><br>
                                Data kasir belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection