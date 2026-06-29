@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header_title', 'Edit Produk')
@section('header_subtitle', 'Perbarui detail data katalog produk')

@section('content')

    <div class="content-card" style="max-width: 800px;">
        <div class="card-header">
            <h3>Form Edit Produk: {{ $product->name }}</h3>
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="name">Nama Produk / Model HP</label>
                    <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
                </div>

                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control" required value="{{ old('brand', $product->brand) }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="price">Harga (Rupiah)</label>
                    <input type="number" id="price" name="price" class="form-control" required value="{{ old('price', intval($product->price)) }}">
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="image_url">URL Gambar Produk</label>
                <input type="url" id="image_url" name="image_url" class="form-control" value="{{ old('image_url', $product->image_url) }}">
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection
