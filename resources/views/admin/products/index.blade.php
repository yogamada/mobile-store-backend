@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('header_title', 'Manajemen Produk')
@section('header_subtitle', 'Tambah, edit, dan hapus katalog handphone dan aksesoris')

@section('content')

    <div class="content-card">
        <div class="card-header">
            <h3>Daftar Produk HP</h3>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Produk</span>
            </a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">Gambar</th>
                        <th>Model HP</th>
                        <th>Brand</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width: 180px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                                @else
                                    <div style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color);">
                                        <i class="fa-solid fa-image" style="color: var(--text-muted);"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: 600;">{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock <= 3)
                                    <span style="color: var(--danger); font-weight: 700;">{{ $product->stock }} (Hampir Habis)</span>
                                @else
                                    <span style="color: var(--success); font-weight: 600;">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 13px;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 48px 0;">
                                Belum ada produk. Silakan tambahkan produk baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
