@extends('layouts.app')

@section('title', 'Edit Kasir')

@section('content')
<style>
    .cashier-header {
        display: flex;
        align-items: center;
        gap: 18px;
        border-bottom: 1.5px solid #f0f1f7;
        padding-bottom: 1.2rem;
        margin-bottom: 1.8rem;
    }
    .cashier-header .avatar {
        background: linear-gradient(135deg,#6dc6fd 0%,#3687f5 100%);
        border-radius: 100%;
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px 0 rgba(54,135,245,.12);
    }
    .cashier-header .avatar i {
        font-size: 2rem;
        color: #fff;
    }
    .cashier-header .title {
        font-size: 1.45rem;
        font-weight: 700;
        color: #3687f5;
        margin-bottom: 3px;
    }
    .cashier-header .desc {
        font-size: .97rem;
        color: #7b849c;
    }
    .form-label {
        font-weight: 600;
        color: #3687f5;
        letter-spacing: 0.5px;
    }
    .form-control {
        border-radius: 1.2rem;
        border: 1.5px solid #e3eaff;
        background: #f7faff;
        transition: .2s;
    }
    .form-control:focus {
        border-color: #3687f5;
        background: #fff;
        box-shadow: 0 0 0 2px #cce2ff77;
    }
    .form-control.is-invalid {
        border-color: #f44336;
        background: #fff4f4;
    }
    .invalid-feedback {
        color: #f44336;
    }
    .btn-gradient-primary {
        background: linear-gradient(90deg, #6dc6fd 0%, #3687f5 100%);
        color: #fff;
        border: none;
        font-weight: 600;
        border-radius: 2rem;
        box-shadow: 0 3px 12px -2px #6dc6fd33;
        transition: .18s;
    }
    .btn-gradient-primary:hover, .btn-gradient-primary:focus {
        background: linear-gradient(90deg, #3687f5 0%, #6dc6fd 100%);
        color: #fff;
        transform: scale(1.035);
    }
    .btn-outline-secondary {
        border-radius: 2rem;
        padding-left: 20px;
        padding-right: 20px;
    }
    .d-flex.gap-2 > * {
        margin-right: .5rem;
    }
    .d-flex.gap-2 > *:last-child {
        margin-right: 0;
    }
</style>
<div class="container mt-4">
    <div class="cashier-header">
        <div class="avatar">
            <i class="bi bi-person-badge-fill"></i>
        </div>
        <div>
            <div class="title">Edit Kasir</div>
            <div class="desc">Ubah informasi kasir di bawah ini</div>
        </div>
    </div>
    <form action="{{ route('cashiers.update', $cashier->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-person-fill me-1"></i>Nama Kasir
            </label>
            <input type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $cashier->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope-fill me-1"></i>Email Kasir
            </label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $cashier->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-key-fill me-1"></i>Password Baru
                <span class="text-muted ms-1" style="font-size:.95em;">(kosongkan jika tidak ingin mengubah)</span>
            </label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">
                <i class="bi bi-key-fill me-1"></i>Konfirmasi Password Baru
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control" autocomplete="new-password">
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
            <a href="{{ route('cashiers.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-gradient-primary px-4">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
