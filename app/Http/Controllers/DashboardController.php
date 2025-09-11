<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Application;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $isAdminUnit = $user->hasRole('admin-unit');
            $unitId = $user->unit_id;

            $query = Application::query();
            if ($isAdminUnit) {
                $query->where('unit_id', $unitId);
            }

            (clone $query)
                ->whereDate('masa_berlaku', '<', now())
                ->where('status', '!=', 'non-aktif')
                ->update(['status' => 'non-aktif']);

            $totalBiaya = (clone $query)->sum('harga');
            $totalAplikasi = (clone $query)->count();
            $aplikasiAktif = (clone $query)->where('status', 'aktif')->count();
            $aplikasiNonaktif = (clone $query)->where('status', 'non-aktif')->count();
            $aplikasiPerBulan = (clone $query)
                ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
                ->whereYear('created_at', now()->year)
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->pluck('total', 'bulan')
                ->toArray();

            $dataBulan = [];
            $dataJumlah = [];
            for ($i = 1; $i <= 12; $i++) {
                $dataBulan[] = Carbon::create()->month($i)->format('M');
                $dataJumlah[] = $aplikasiPerBulan[$i] ?? 0;
            }

            $topLokasi = (clone $query)
                ->selectRaw('lokasi_pembelian_id, COUNT(*) as total')
                ->with('lokasiPembelian')
                ->groupBy('lokasi_pembelian_id')
                ->orderByDesc('total')
                ->limit(2)
                ->get();

            $topLokasiLabels = $topLokasi->map(function($item) {
                return $item->lokasiPembelian->nama ?? 'N/A';
            })->toArray();
            $topLokasiData = $topLokasi->pluck('total')->toArray();
            $aplikasiHampirExpired = (clone $query)
                ->whereDate('masa_berlaku', '<=', now()->addDays(11))
                ->orderBy('masa_berlaku')
                ->get()
                ->map(function ($app) {
                    $app->sisa_hari = Carbon::parse($app->masa_berlaku)->diffInDays(now(), false);
                    return $app;
                });
            $latestApps = (clone $query)->latest()->take(3)->get();

            return view('dashboard', compact(
                'totalBiaya',
                'totalAplikasi',
                'aplikasiAktif',
                'aplikasiNonaktif',
                'dataBulan',
                'dataJumlah',
                'topLokasiLabels',
                'topLokasiData',
                'aplikasiHampirExpired',
                'latestApps'
            ));
        } catch (\Exception $e) {
            Log::error('Gagal memuat data dashboard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat dashboard.');
        }
    }
}