<?php

namespace App\Http\Controllers;

use App\Models\LokasiPembelian;
use Illuminate\Http\Request;

class LokasiPembelianController extends Controller
{
    // Tampilkan semua lokasi
    public function index()
    {
        $lokasi = LokasiPembelian::all();
        return view('lokasi_pembelian.index', compact('lokasi'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('lokasi_pembelian.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        LokasiPembelian::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $lokasi = LokasiPembelian::findOrFail($id);
        return view('lokasi_pembelian.edit', compact('lokasi'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $lokasi = LokasiPembelian::findOrFail($id);
        $lokasi->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $lokasi = LokasiPembelian::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('lokasi_pembelian.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}
