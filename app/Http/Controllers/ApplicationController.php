<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        // Search berdasarkan nama aplikasi
        if ($request->has('search') && $request->search !== '') {
            $query->where('nama_aplikasi', 'like', '%' . $request->search . '%');
        }

        $applications = $query->latest()->get();

        return view('applications.index', compact('applications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aplikasi'     => 'required',
            'versi'             => 'nullable',
            'kategori'          => 'nullable',
            'status'            => 'nullable|in:Aktif,Non-Aktif',
            'harga'             => 'nullable',
            'tanggal_pembelian' => 'nullable|date',
            'lokasi_pembelian'  => 'nullable|in:Official,E-Commerce',
            'deskripsi'         => 'nullable',
            'bukti_pembelian'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Simpan bukti jika ada file
        if ($request->hasFile('bukti_pembelian')) {
            $validated['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti', 'public');
        }

        Application::create($validated);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'nama_aplikasi'     => 'required',
            'versi'             => 'nullable',
            'kategori'          => 'nullable',
            'status'            => 'nullable|in:Aktif,Non-Aktif',
            'harga'             => 'nullable',
            'tanggal_pembelian' => 'nullable|date',
            'lokasi_pembelian'  => 'nullable|in:Official,E-Commerce',
            'deskripsi'         => 'nullable',
            'bukti_pembelian'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Jika user upload file baru, hapus yang lama
        if ($request->hasFile('bukti_pembelian')) {
            if ($application->bukti_pembelian) {
                Storage::disk('public')->delete($application->bukti_pembelian);
            }

            $validated['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti', 'public');
        }

        $application->update($validated);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Application $application)
    {
        if ($application->bukti_pembelian) {
            Storage::disk('public')->delete($application->bukti_pembelian);
        }

        $application->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
