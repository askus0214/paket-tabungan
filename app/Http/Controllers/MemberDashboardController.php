<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving; // <-- Pastikan Model Saving di-import di atas sini
use Illuminate\Http\JsonResponse;

class MemberDashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil data user yang sedang login saat ini
        $user = auth()->user();

        // 2. Mengambil semua data program tabungan milik user tersebut,
        //    sekaligus me-load data paketnya ('package') agar tidak terjadi N+1 query issue.
        $savings = $user->savings()->with('package')->get();

        // 3. Mengirimkan data tabungan ke view 'member.dashboard'
        return view('member.dashboard', compact('savings'));
    }

    /**
     * Mengambil riwayat transaksi paket tabungan tertentu secara real-time (AJAX)
     */
    public function getTransactions($id): JsonResponse
    {
        // Mengambil paket tabungan berdasarkan ID, pastikan itu milik user yang sedang login
        $saving = Saving::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('package') // Memuat info paketnya sekaligus
            ->firstOrFail();

        // Mengambil data transaksi yang terhubung dengan tabungan ini, diurutkan dari yang terbaru
        // Catatan: Pastikan di model 'Saving' kamu sudah ada fungsi: public function transactions()
        $transactions = $saving->transactions()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'saving_name' => $saving->package->title ?? 'Detail Transaksi',
            'transactions' => $transactions
        ]);
    }
}
