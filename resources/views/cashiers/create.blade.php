@extends('layouts.app')

@section('title', 'Tambah Kasir')

@section('content')
<style>
    .cashier-card {
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
        background: #fff;
        margin-top: 2rem;
        margin-bottom: 2rem;
        padding: 2rem 1.5rem;
    }
    .input-group-text {
        background: linear-gradient(90deg, #0d6efd 60%, #43c6ac 100%);
        color: #fff;
        font-weight: bold;
        border-radius: .7rem 0 0 .7rem;
    }
    .form-label {
        font-weight: 600;
        letter-spacing: .03em;
    }
    .btn-gradient-success {
        background: linear-gradient(90deg, #43e97b 60%, #38f9d7 100%);
        color: #fff;
        font-weight: bold;
        border: none;
    }
    .btn-gradient-success:hover {
        background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
        color: #fff;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="cashier-card">
                <div class="mb-4 text-center">
                    <h2 class="fw-bold text-primary mb-1"><i class="bi bi-person-plus-fill me-1"></i> Tambah Kasir Baru</h2>
                    <div class="text-muted">Isi data lengkap kasir yang akan ditambahkan</div>
                </div>

                <form action="{{ route('cashiers.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('cashiers.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient-success px-4">
                            <i class="bi bi-check-circle me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection