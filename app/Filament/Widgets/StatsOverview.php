<?php

namespace App\Filament\Widgets;

use App\Models\Saving;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // 1. Total Member & Tren Registrasi
        $totalMember = User::where('role', 'member')->count();
        $memberTrend = User::where('role', 'member')
            ->selectRaw('COUNT(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();

        // 2. Total Tabungan (Membaca kolom 'current_amount') & Tren Pertumbuhan
        $totalNominalTabungan = Saving::sum('current_amount') ?? 0;
        $savingTrend = Saving::selectRaw('SUM(current_amount) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();

        // 3. Total Transaksi & Tren Nominal Transaksi Masuk
        $totalTransaksi = Transaction::count();
        $transactionTrend = Transaction::selectRaw('SUM(amount) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();

        return [
            Stat::make('Total Member', $totalMember . ' Orang')
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart(!empty($memberTrend) ? $memberTrend : [0, $totalMember]),

            Stat::make('Total Tabungan', 'Rp ' . number_format($totalNominalTabungan, 0, ',', '.'))
                ->description('Total dana terkumpul')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning')
                ->chart(!empty($savingTrend) ? $savingTrend : [0, $totalNominalTabungan]),

            Stat::make('Total Transaksi', $totalTransaksi . ' Transaksi')
                ->description('Aktivitas mutasi masuk')
                ->descriptionIcon('heroicon-m-arrows-right-left')
                ->color('info')
                ->chart(!empty($transactionTrend) ? $transactionTrend : [0, $totalTransaksi]),
        ];
    }
}
