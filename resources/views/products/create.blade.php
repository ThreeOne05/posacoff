@extends('layouts.app')

@section('content')
<style>
    .card-product {
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .card-header {
        border-radius: 1.25rem 1.25rem 0 0 !important;
        background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%);
        letter-spacing: .05em;
    }
    .form-label {
        font-weight: 600;
        letter-spacing: .03em;
    }
    .preview-img {
        max-width: 120px;
        max-height: 120px;
        display: block;
        margin-bottom: .5rem;
        border-radius: .75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card card-product">
                <div class="card-header text-white text-center fs-4 fw-bold py-3">
                    <i class="bi bi-box-seam me-2"></i>Tambah Produk Baru
                </div>
                <div class="card-body px-4">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control shadow-sm" id="name" name="name" required >
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select shadow-sm" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required placeholder="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image_path" class="form-label">Gambar Produk <span class="text-muted">(opsional)</span></label>
                            <input class="form-control shadow-sm" type="file" id="image_path" name="image_path" accept="image/*" onchange="previewImage(event)">
                            <img id="preview" class="preview-img d-none" alt="Image Preview">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-gradient-primary fw-semibold">
                                <i class="bi bi-save me-1"></i>Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Bootstrap icon CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script>
function previewImage(event) {
    const [file] = event.target.files;
    const preview = document.getElementById('preview');
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    } else {
        preview.src = '';
        preview.classList.add('d-none');
    }
}
</script>
@endsection