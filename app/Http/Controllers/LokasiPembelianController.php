<?php

namespace App\Http\Controllers;

use App\Models\LokasiPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class LokasiPembelianController extends Controller
{
    public function index()
    {
        try {
            $lokasi = LokasiPembelian::all();
            return view('lokasi_pembelian.index', compact('lokasi'));
        } catch (Exception $e) {
            Log::error('Gagal menampilkan lokasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan data.');
        }
    }

    public function create()
    {
        try {
            return view('lokasi_pembelian.create');
        } catch (Exception $e) {
            Log::error('Gagal membuka form create lokasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka halaman tambah.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        DB::beginTransaction();
        try {
            LokasiPembelian::create([
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil ditambahkan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan lokasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan lokasi. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        try {
            $lokasi = LokasiPembelian::findOrFail($id);
            return view('lokasi_pembelian.edit', compact('lokasi'));
        } catch (Exception $e) {
            Log::error("Gagal membuka form edit lokasi ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka halaman edit.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $lokasi = LokasiPembelian::findOrFail($id);
            $lokasi->update([
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil diperbarui!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Gagal mengupdate lokasi ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui lokasi. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $lokasi = LokasiPembelian::findOrFail($id);
            $lokasi->delete();

            DB::commit();
            return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil dihapus!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Gagal menghapus lokasi ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus lokasi. Silakan coba lagi.');
        }
    }

    public function ajaxStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $lokasi = LokasiPembelian::create([
                'nama' => $request->nama,
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'lokasi' => $lokasi,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan lokasi via AJAX: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan. Lokasi tidak dapat ditambahkan.',
            ], 500);
        }
    }

    public function json()
    {
        try {
            $lokasis = LokasiPembelian::select('id', 'nama')->get();

            return response()->json($lokasis);
        } catch (Exception $e) {
            Log::error('Gagal mengambil data lokasi JSON: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data lokasi.',
            ], 500);
        }
    }
}
