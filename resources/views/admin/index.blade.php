@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')
@section('header_title', 'Ringkasan')
@section('header_subtitle', 'Statistik toko dan laporan penjualan')

@section('content')

    {{-- ═══════════════════════════════════════════════════
         STAT CARDS — 3 column grid
    ═══════════════════════════════════════════════════ --}}
    <div class="stats-grid">

        {{-- Total Penjualan --}}
        <div class="stat-card sales">
            <div class="stat-top-row">
                <span class="stat-label">Total Penjualan</span>
                <div class="stat-icon-badge">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <div>
                <div class="stat-value" style="font-size:22px;">
                    Rp {{ number_format($totalSales, 0, ',', '.') }}
                </div>
            </div>
            <div class="stat-trend">
                <i class="fa-solid fa-arrow-trend-up trend-up"></i>
                <span class="trend-up">+12% hari ini</span>
                <span style="margin-left:4px; color:var(--text-dim);">vs kemarin</span>
            </div>
        </div>

        {{-- Total Konsumen --}}
        <div class="stat-card customers">
            <div class="stat-top-row">
                <span class="stat-label">Total Konsumen</span>
                <div class="stat-icon-badge">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ $totalCustomers }}</div>
            </div>
            <div class="stat-trend">
                <i class="fa-solid fa-circle-dot" style="color:var(--info);"></i>
                <span>{{ $totalCustomers }} akun terdaftar</span>
            </div>
        </div>

        {{-- Produk HP --}}
        <div class="stat-card products">
            <div class="stat-top-row">
                <span class="stat-label">Produk HP</span>
                <div class="stat-icon-badge">
                    <i class="fa-solid fa-mobile-button"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ $totalProducts }}</div>
            </div>
            <div class="stat-trend">
                <i class="fa-solid fa-arrow-trend-up trend-up"></i>
                <span class="trend-up">+3 model</span>
                <span style="margin-left:4px; color:var(--text-dim);">bulan ini</span>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════
         TRANSAKSI TERBARU
    ═══════════════════════════════════════════════════ --}}
    <div class="content-card">
        <div class="card-header">
            <div class="card-title-block">
                <div class="card-title-accent"></div>
                <h3>Transaksi Terbaru</h3>
            </div>
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                Lihat Semua
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:9px;">
                                    <div style="
                                        width: 28px; height: 28px;
                                        border-radius: 7px;
                                        background: rgba(79,142,247,0.12);
                                        display: flex; align-items: center; justify-content: center;
                                        font-size: 11px; font-weight: 700; color: var(--primary);
                                        flex-shrink: 0;
                                    ">
                                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span style="font-weight: 600; font-size: 13.5px;">{{ $order->user->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: var(--accent); white-space: nowrap;">
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
                            <td style="color: var(--text-sub); font-size: 12px; white-space: nowrap;">
                                {{ $order->created_at->format('d M Y') }}<br>
                                <span style="color: var(--text-dim);">{{ $order->created_at->format('H:i') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div style="
                                    display: flex; flex-direction: column;
                                    align-items: center; justify-content: center;
                                    padding: 40px 20px; gap: 10px;
                                    color: var(--text-dim);
                                ">
                                    <i class="fa-solid fa-receipt" style="font-size: 28px; opacity: 0.4;"></i>
                                    <span style="font-size: 13px;">Belum ada pesanan masuk.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Auto-refresh the dashboard every 10 seconds for real-time order/customer updates
        setTimeout(function() {
            window.location.reload();
        }, 10000);
    </script>
@endsection
