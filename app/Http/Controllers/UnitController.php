<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitController extends Controller
{
    public function index()
    {
        try {
            $units = Unit::with('parent')->orderBy('urut')->get();
            return view('units.index', compact('units'));
        } catch (\Throwable $e) {
            Log::error('Error fetching units: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data unit.');
        }
    }

    public function create()
    {
        try {
            $parents = Unit::orderBy('nama')->get();
            return view('units.create', compact('parents'));
        } catch (\Throwable $e) {
            Log::error('Error preparing create unit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mempersiapkan form unit.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required',
            'nama' => 'required|string',
            'singkatan' => 'required|string|max:10',
            'urut' => 'nullable|integer',
            'parent_id' => 'nullable|exists:units,id',
            'aktif' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            Unit::create($request->all());
            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error storing unit: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan unit.');
        }
    }

    public function edit(Unit $unit)
    {
        try {
            $parents = Unit::where('id', '!=', $unit->id)->orderBy('nama')->get();
            return view('units.edit', compact('unit', 'parents'));
        } catch (\Throwable $e) {
            Log::error('Error preparing edit unit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data unit.');
        }
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'no' => 'required',
            'nama' => 'required|string',
            'singkatan' => 'required|string|max:10',
            'urut' => 'nullable|integer',
            'parent_id' => 'nullable|exists:units,id',
            'aktif' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            $unit->update([
                'no' => $request->no,
                'nama' => $request->nama,
                'singkatan' => $request->singkatan,
                'urut' => $request->urut,
                'parent_id' => $request->parent_id,
                'aktif' => $request->aktif,
            ]);
            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error updating unit: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui unit.');
        }
    }

    public function destroy(Unit $unit)
    {
        DB::beginTransaction();
        try {
            $unit->delete();
            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error deleting unit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus unit.');
        }
    }
}
