<x-app-layout>
    <x-slot name="header">
        {{ $application->nama_aplikasi }}
    </x-slot>

    <div class="container mt-4">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3 border-bottom">
            <li class="nav-item">
                <a id="tabDetail" class="nav-link active custom-tab text-primary" href="#" onclick="showTab('detail')">
                    <i class="bi bi-search"></i> Detail
                </a>
            </li>
            <li class="nav-item">
                <a id="tabBukti" class="nav-link custom-tab text-dark" href="#" onclick="showTab('bukti')">
                    <i class="bi bi-receipt"></i> Bukti Pembelian
                </a>
            </li>
        </ul>

        <!-- Detail Tab -->
        <div id="tabContentDetail">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
    <td class="fw-bold text-primary" style="width: 200px;">Status</td>
    <td style="border-bottom: 1px solid #dee2e6;">
        @if ($application->status === 'Aktif')
            <span class="badge bg-success">Aktif</span>
        @elseif ($application->status === 'Non-Aktif')
            <span class="badge bg-danger">Non-Aktif</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
</tr>
                                <tr>
                                    <td class="fw-bold text-primary">Harga</td>
                                    <td style="border-bottom: 1px solid #dee2e6;">{{ $application->harga ? 'Rp ' . number_format($application->harga, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Tanggal Pembelian</td>
                                    <td style="border-bottom: 1px solid #dee2e6;">
                                        {{ $application->tanggal_pembelian ? \Carbon\Carbon::parse($application->tanggal_pembelian)->format('d F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Lokasi Pembelian</td>
<td style="border-bottom: 1px solid #dee2e6;">
    {{ $application->lokasiPembelian->nama ?? '-' }}
</td>

                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Deskripsi</td>
                                    <td style="border-bottom: 1px solid #dee2e6;">{{ $application->deskripsi ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bukti Pembelian Tab -->
        <div id="tabContentBukti" style="display: none;">
            <div class="card shadow-sm">
                <div class="card-body p-4 text-center">
                    @if ($application->bukti_pembelian)
                        <img src="{{ asset('storage/' . $application->bukti_pembelian) }}" class="img-fluid rounded shadow-sm" alt="Bukti Pembelian">
                    @else
                        <p class="text-muted">Tidak ada bukti pembelian tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('applications.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        function showTab(tab) {
            const tabDetail = document.getElementById('tabDetail');
            const tabBukti = document.getElementById('tabBukti');
            const contentDetail = document.getElementById('tabContentDetail');
            const contentBukti = document.getElementById('tabContentBukti');

            if (tab === 'detail') {
                tabDetail.classList.add('active', 'text-primary');
                tabDetail.classList.remove('text-dark');
                tabBukti.classList.remove('active', 'text-primary');
                tabBukti.classList.add('text-dark');
                contentDetail.style.display = 'block';
                contentBukti.style.display = 'none';
            } else {
                tabBukti.classList.add('active', 'text-primary');
                tabBukti.classList.remove('text-dark');
                tabDetail.classList.remove('active', 'text-primary');
                tabDetail.classList.add('text-dark');
                contentDetail.style.display = 'none';
                contentBukti.style.display = 'block';
            }
        }
    </script>
    @endpush
</x-app-layout>
