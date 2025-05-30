@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f0fdfa 100%);
        min-height: 100vh;
    }
    .edit-product-wrapper {
        max-width: 760px;
        margin: 56px auto 0 auto;
        background: #fff;
        border-radius: 1.6rem;
        box-shadow: 0 14px 38px 0 rgba(34,197,94,0.13), 0 2.5px 22px rgba(34,139,230,0.13);
        padding: 3.5rem 3rem 2.7rem 3rem;
        position: relative;
        overflow: hidden;
    }
    .edit-product-wrapper:before {
        content: '';
        position: absolute;
        top: -130px; left: -130px;
        width: 260px; height: 260px;
        background: radial-gradient(circle, #38bdf8 0%, #e0e7ff 100%);
        opacity: .16;
        z-index: 0;
    }
    .edit-product-title {
        font-family: 'Fira Mono', monospace;
        color: #2563eb;
        font-size: 2.12rem;
        font-weight: 700;
        margin-bottom: 2.1rem;
        letter-spacing: 0.03em;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        z-index: 1;
        position: relative;
    }
    .form-label {
        color: #2563eb;
        font-weight: 600;
        letter-spacing: 0.01em;
        font-size: 1.25rem;
        margin-bottom: 0.8rem;
    }
    .form-control, .form-select {
        border-radius: 1.2rem;
        border: 2px solid #bae6fd;
        font-size: 1.38rem;
        height: 3.2rem;
        padding-left: 3.4rem;
        padding-right: 1.1rem;
        margin-bottom: 0.5rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px #bae6fd;
    }
    .product-image-preview {
        margin-top: 0.75rem;
        margin-bottom: 0.8rem;
        position: relative;
        width: 170px;
        height: 170px;
        border-radius: 1.25rem;
        box-shadow: 0 7px 24px rgba(34,139,230,0.13);
        overflow: hidden;
    }
    .product-image-preview img {
        width: 100%; height: 100%; object-fit: cover;
        border-radius: 1.25rem;
        background: #f1f5f9;
    }
    .btn-primary {
        background: linear-gradient(90deg, #38bdf8 60%, #1ebd54 100%);
        border: none;
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: 0.045em;
        border-radius: 1.19rem;
        box-shadow: 0 3px 13px rgba(34,197,94,0.13);
        padding: 1rem 2.9rem;
        transition: background .14s;
    }
    .btn-primary:hover, .btn-primary:focus {
        background: linear-gradient(95deg, #2563eb 60%, #38bdf8 100%);
    }
    .btn-secondary {
        border-radius: 1.19rem;
        font-weight: 600;
        font-size: 1.13rem;
        letter-spacing: 0.03em;
        margin-left: 1.1rem;
        padding: 1rem 2.4rem;
    }
    .invalid-feedback {
        font-size: 1.07rem;
    }
    .input-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #38bdf8;
        font-size: 1.75rem;
    }
    .input-group {
        position: relative;
        margin-bottom: 2.1rem;
    }
    @media (max-width: 900px) {
        .edit-product-wrapper { max-width: 98vw; padding: 2.2rem 0.8rem; }
    }
    @media (max-width: 650px) {
        .edit-product-title { font-size: 1.2rem; gap: .7rem;}
        .edit-product-wrapper { padding: 1.2rem 0.2rem; }
        .form-control, .form-select { font-size: 1.06rem; height: 2.2rem; padding-left: 2.1rem;}
        .btn-primary, .btn-secondary { font-size: .99rem; padding: 0.6rem 1.3rem;}
        .product-image-preview { width: 110px; height: 110px;}
    }
</style>
<div class="edit-product-wrapper">
    <div class="edit-product-title">
        <i class="bi bi-pencil-square"></i>
        Edit Produk
    </div>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')

        {{-- Gambar --}}
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <div class="product-image-preview" id="previewContainer">
                @if($product->image)
                    <img id="imgPreview" src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk">
                @else
                    <img id="imgPreview" src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=bae6fd&color=2563eb" alt="No Image">
                @endif
            </div>
            <input type="file" name="image" id="image" accept="image/*"
                   class="form-control @error('image') is-invalid @enderror"
                   onchange="previewImage(event)">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama Produk --}}
        <div class="input-group">
            <span class="input-icon"><i class="bi bi-box-seam"></i></span>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nama Produk"
                   value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="input-group">
            <span class="input-icon"><i class="bi bi-cash-stack"></i></span>
            <input type="number" name="price" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   placeholder="Harga Produk"
                   value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="input-group">
            <span class="input-icon"><i class="bi bi-tags"></i></span>
            <select name="category_id" id="category_id"
                    class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save2"></i> Simpan Perubahan
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Batal
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('imgPreview').src = URL.createObjectURL(file);
    }
}
</script>
@endsection