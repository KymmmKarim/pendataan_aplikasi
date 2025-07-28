<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Application::query();

            if (auth()->user()->hasRole('admin-unit')) {
                $query->where('unit_id', auth()->user()->unit_id);
            }

            if ($request->has('search') && $request->search !== '') {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_aplikasi', 'like', '%' . $search . '%')
                      ->orWhere('versi', 'like', '%' . $search . '%')
                      ->orWhere('masa_berlaku', 'like', '%' . $search . '%');
                });
            }

            $applications = $query->latest()->paginate(10)->withQueryString();
            $units = Unit::all();

            return view('applications.index', compact('applications', 'units'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'nama_aplikasi'     => 'required',
                'versi'             => 'nullable',
                'masa_berlaku'      => 'nullable|date',
                'status'            => 'nullable|in:Aktif,Non-Aktif',
                'harga'             => 'nullable',
                'tanggal_pembelian' => 'nullable|date',
                'lokasi_pembelian'  => 'nullable|in:Official,E-Commerce',
                'deskripsi'         => 'nullable',
                'bukti_pembelian'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            ];

            if (!auth()->user()->hasRole('admin-unit')) {
                $rules['unit_id'] = 'required|exists:units,id';
            }

            $validated = $request->validate($rules);

            if (auth()->user()->hasRole('admin-unit')) {
                $validated['unit_id'] = auth()->user()->unit_id;
            }

            if ($request->hasFile('bukti_pembelian')) {
                $validated['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti', 'public');
            }

            Application::create($validated);
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
        }
    }

    public function show(Application $application)
    {
        try {
            // Hanya tampilkan jika admin-unit adalah pemilik unit
            if (auth()->user()->hasRole('admin-unit') && $application->unit_id !== auth()->user()->unit_id) {
                abort(403, 'Unauthorized access.');
            }

            $units = Unit::all();
            return view('applications.show', compact('application', 'units'));
        } catch (\Exception $e) {
            Log::error('Gagal menampilkan detail aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat detail.');
        }
    }

    public function update(Request $request, Application $application)
    {
        DB::beginTransaction();
        try {
            // Cek akses berdasarkan role & unit
            if (auth()->user()->hasRole('admin-unit') && $application->unit_id !== auth()->user()->unit_id) {
                abort(403, 'Unauthorized update.');
            }

            $rules = [
                'nama_aplikasi'     => 'required',
                'versi'             => 'nullable',
                'masa_berlaku'      => 'nullable|date',
                'status'            => 'nullable|in:Aktif,Non-Aktif',
                'harga'             => 'nullable',
                'tanggal_pembelian' => 'nullable|date',
                'lokasi_pembelian'  => 'nullable|in:Official,E-Commerce',
                'deskripsi'         => 'nullable',
                'bukti_pembelian'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            ];

            if (!auth()->user()->hasRole('admin-unit')) {
                $rules['unit_id'] = 'required|exists:units,id';
            }

            $validated = $request->validate($rules);

            if (auth()->user()->hasRole('admin-unit')) {
                $validated['unit_id'] = auth()->user()->unit_id; // Jangan ambil dari form
            }

            if ($request->hasFile('bukti_pembelian')) {
                if ($application->bukti_pembelian) {
                    Storage::disk('public')->delete($application->bukti_pembelian);
                }
                $validated['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti', 'public');
            }

            $application->update($validated);
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal mengupdate aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(Application $application)
    {
        DB::beginTransaction();
        try {
            if (auth()->user()->hasRole('admin-unit') && $application->unit_id !== auth()->user()->unit_id) {
                abort(403, 'Unauthorized delete.');
            }

            if ($application->bukti_pembelian) {
                Storage::disk('public')->delete($application->bukti_pembelian);
            }

            $application->delete();
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}