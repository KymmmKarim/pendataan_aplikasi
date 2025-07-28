<x-app-layout>
    <x-slot name="header">
        Edit Lokasi Pembelian
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('lokasi_pembelian.update', $lokasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lokasi Pembelian</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $lokasi->nama) }}" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('lokasi_pembelian.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
