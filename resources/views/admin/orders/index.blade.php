@extends('layouts.admin')

@section('title', 'Log Penjualan Toko')
@section('header_title', 'Manajemen Penjualan')
@section('header_subtitle', 'Laporan lengkap riwayat transaksi dan detail produk yang dibeli konsumen')

@section('content')

    <div class="content-card">
        <div class="card-header">
            <h3>Daftar Transaksi Pelanggan</h3>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 90px;">ID Order</th>
                        <th>Konsumen</th>
                        <th>Detail Barang yang Dibeli</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 500;">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $order->user->name }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $order->user->email }}</div>
                            </td>
                            <td>
                                <ul style="list-style: none; padding-left: 0;">
                                    @foreach($order->items as $item)
                                        <li style="margin-bottom: 6px; font-size: 14px;">
                                            <i class="fa-solid fa-caret-right" style="color: var(--primary); margin-right: 6px;"></i>
                                            <strong>{{ $item->product->name ?? 'Produk Dihapus' }}</strong> 
                                            <span style="color: var(--text-muted);">({{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td style="font-weight: 700; color: var(--success); font-size: 16px;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($order->status === 'completed')
                                    <span class="badge badge-success">completed</span>
                                @elseif($order->status === 'pending')
                                    <span class="badge badge-warning">pending</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-danger">cancelled</span>
                                @else
                                    <span class="badge badge-secondary">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td style="color: var(--text-muted); font-size: 14px;">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 48px 0;">
                                Belum ada riwayat transaksi penjualan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
