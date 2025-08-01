<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\LokasiPembelian;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Application::query();

            if (auth()->user()->hasRole('admin-unit')) {
                $query->where('unit_id', auth()->user()->unit_id);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_aplikasi', 'like', "%$search%")
                      ->orWhere('versi', 'like', "%$search%")
                      ->orWhere('masa_berlaku', 'like', "%$search%");
                });
            }

            $applications = $query->latest()->paginate(10)->withQueryString();
            $units = Unit::all();
            $lokasiPembelians = LokasiPembelian::all();

            return view('applications.index', compact('applications', 'units', 'lokasiPembelians'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'harga' => $request->harga ? str_replace('.', '', $request->harga) : null
            ]);

            $rules = [
                'nama_aplikasi'         => 'required',
                'versi'                 => 'nullable',
                'masa_berlaku'          => 'nullable|date',
                'status'                => 'nullable|in:Aktif,Non-Aktif',
                'harga'                 => 'nullable|numeric|min:0',
                'tanggal_pembelian'     => 'nullable|date',
                'lokasi_pembelian_id'   => 'nullable|exists:lokasi_pembelians,id',
                'deskripsi'             => 'nullable',
                'bukti_pembelian'       => 'nullable|file|mimes:jpg,jpeg,png,pdf',
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

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
        }
    }

    public function show(Application $application)
    {
        try {
            if (auth()->user()->hasRole('admin-unit') && $application->unit_id !== auth()->user()->unit_id) {
                abort(403, 'Unauthorized access.');
            }

            $units = Unit::all();
            $lokasiPembelians = LokasiPembelian::all();

            return view('applications.show', compact('application', 'units', 'lokasiPembelians'));

        } catch (\Exception $e) {
            Log::error('Gagal menampilkan detail aplikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat detail.');
        }
    }

    public function update(Request $request, Application $application)
    {
        DB::beginTransaction();

        try {
            if (auth()->user()->hasRole('admin-unit') && $application->unit_id !== auth()->user()->unit_id) {
                abort(403, 'Unauthorized update.');
            }

            $request->merge([
                'harga' => $request->harga ? str_replace('.', '', $request->harga) : null
            ]);

            $rules = [
                'nama_aplikasi'         => 'required',
                'versi'                 => 'nullable',
                'masa_berlaku'          => 'nullable|date',
                'status'                => 'nullable|in:Aktif,Non-Aktif',
                'harga'                 => 'nullable|numeric|min:0',
                'tanggal_pembelian'     => 'nullable|date',
                'lokasi_pembelian_id'   => 'nullable|exists:lokasi_pembelians,id',
                'deskripsi'             => 'nullable',
                'bukti_pembelian'       => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            ];

            if (!auth()->user()->hasRole('admin-unit')) {
                $rules['unit_id'] = 'required|exists:units,id';
            }

            $validated = $request->validate($rules);

            if (auth()->user()->hasRole('admin-unit')) {
                $validated['unit_id'] = auth()->user()->unit_id;
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

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();

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
