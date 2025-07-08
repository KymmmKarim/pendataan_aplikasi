<x-app-layout>
    <x-slot name="header">
        Nama Aplikasi
    </x-slot>

    <div class="container mt-4">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3 border-bottom">
            <li class="nav-item">
                <a class="nav-link active custom-tab" aria-current="page" href="#">
                    <i class="bi bi-search"></i> Detail
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-tab" href="#">
                    <i class="bi bi-receipt"></i> Bukti Pembelian
                </a>
            </li>
        </ul>



        <!-- Card detail -->
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-primary" style="width: 200px;">Status</td>
                                <td style="border-bottom: 1px solid #dee2e6;">Aktif / Nonaktif</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Harga</td>
                                <td style="border-bottom: 1px solid #dee2e6;">20.000.000</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Tanggal Pembelian</td>
                                <td style="border-bottom: 1px solid #dee2e6;">07-05-2055</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Lokasi Pembelian</td>
                                <td style="border-bottom: 1px solid #dee2e6;">E-Commerce</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Deskripsi</td>
                                <td style="border-bottom: 1px solid #dee2e6;">Info Dasar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tombol kembali -->
        <div class="mt-3">
            <a href="{{ url('/unit') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</x-app-layout>
