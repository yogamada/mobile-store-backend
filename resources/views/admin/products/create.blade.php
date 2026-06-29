@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('header_title', 'Tambah Produk')
@section('header_subtitle', 'Tambahkan model HP atau aksesoris baru ke katalog')

@section('content')

    <div class="content-card" style="max-width: 800px;">
        <div class="card-header">
            <h3>Form Tambah Produk</h3>
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="name">Nama Produk / Model HP</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Contoh: iPhone 15 Pro" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control" placeholder="Contoh: Apple" required value="{{ old('brand') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div clases="form-group">
                    <label for="price">Harga (Rupiah)</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="Contoh: 18000000" required value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" class="form-control" placeholder="Contoh: 10" required value="{{ old('stock') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="image_url">URL Gambar Produk</label>
                <input type="url" id="image_url" name="image_url" class="form-control" placeholder="Contoh: https://images.unsplash.com/..." value="{{ old('image_url') }}">
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea id="description" name="description" class="form-control" placeholder="Tuliskan detail spesifikasi, garansi, atau keunggulan produk disini...">{{ old('description') }}</textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px;">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>

@endsection
