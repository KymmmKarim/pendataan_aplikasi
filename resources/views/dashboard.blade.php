<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="row">
        @php
            $cards = [
                ['icon' => 'far fa-building', 'color' => 'icon-blue',   'value' => isset($totalBiaya) ? 'Rp' . number_format($totalBiaya, 0, ',', '.') : 'Rp 0', 'label' => 'Total Biaya Aplikasi'],
                ['icon' => 'far fa-folder',   'color' => 'icon-yellow', 'value' => $totalAplikasi ?? 0,  'label' => 'Total Aplikasi'],
                ['icon' => 'fas fa-check',    'color' => 'icon-green',  'value' => $aplikasiAktif ?? 0,  'label' => 'Aplikasi Aktif'],
                ['icon' => 'fas fa-times',    'color' => 'icon-red',    'value' => $aplikasiNonaktif ?? 0, 'label' => 'Aplikasi Nonaktif'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-3 mb-3">
                <div class="card-custom">
                    <div class="icon-box {{ $card['color'] }}">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="card-value">{{ $card['value'] }}</div>
                        <div class="card-label">{{ $card['label'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Chart & Todo -->
    <div class="row g-4">
        <!-- Line Chart -->
        <div class="col-md-8">
            <div class="chart-card h-100">
                <h5>Penambahan Aplikasi per Bulan ({{ date('Y') }})</h5>
                <div style="height: 250px;"> 
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Aplikasi Hampir Expired -->
        <div class="col-md-4 d-flex flex-column">
            <div class="chart-card h-100">
                <h5 class="mb-3">Aplikasi Hampir Expired</h5>
                <ul class="list-unstyled" style="max-height: 200px; overflow-y: auto; padding-left: 0.5rem;">
    @forelse ($aplikasiHampirExpired as $app)
        @php
            $sisaHari = $app->sisa_hari;
            if ($sisaHari < 0) {
                $warna = 'dark';
                $label = 'Expired';
            } elseif ($sisaHari <= 5) {
                $warna = 'danger';
                $label = $sisaHari . ' hari lagi';
            } elseif ($sisaHari <= 7) {
                $warna = 'warning';
                $label = $sisaHari . ' hari lagi';
            } elseif ($sisaHari <= 10) {
                $warna = 'secondary';
                $label = $sisaHari . ' hari lagi';
            } else {
                $warna = 'success';
                $label = $sisaHari . ' hari lagi';
            }
        @endphp
        <li class="py-2 border-bottom small">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <div class="text-truncate" style="max-width: 120px;">{{ $app->nama_aplikasi }}</div>
                <div class="text-nowrap">{{ \Carbon\Carbon::parse($app->masa_berlaku)->format('d M Y') }}</div>
                <div><span class="badge bg-{{ $warna }}">{{ $label }}</span></div>
            </div>
        </li>
    @empty
        <li class="text-muted">Tidak ada aplikasi yang akan expired dalam 30 hari.</li>
    @endforelse
</ul>



            </div>
        </div>
    </div>

    
    <div class="row mt-4">
    <!-- Top 2 Lokasi Pembelian -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm p-4">
            <h5 class="mb-4 fw-bold text-primary">Top 2 Lokasi Pembelian Terbanyak</h5>
            <div style="height: 150px;">
                <canvas id="lokasiChart"></canvas>
            </div>
        </div>
    </div>

        <div class="col-md-4 mb-4">
            <div class="chart-card">
                <h5>Aplikasi Terbaru</h5>
                <p class="mb-2">Aplikasi yang baru saja ditambahkan.</p>
                <ul class="list-group list-group-flush small">
    @forelse($latestApps as $app)
        <li class="list-group-item d-flex justify-content-between">
            <span class="text-truncate" style="max-width: 140px;">{{ $app->nama_aplikasi }}</span>
            <span class="text-muted">{{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}</span>
        </li>
    @empty
        <li class="list-group-item text-muted">Belum ada aplikasi terbaru.</li>
    @endforelse
</ul>

            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulanLabels = @json($dataBulan);
        const jumlahData = @json($dataJumlah);

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Jumlah Aplikasi',
                    data: jumlahData,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });

        // Bar Chart: Top Lokasi Pembelian
            // Bar Chart: Top Lokasi Pembelian (Horizontal)
new Chart(document.getElementById('lokasiChart'), {
    type: 'bar',
    data: {
        labels: @json($topLokasiLabels),
        datasets: [{
            label: 'Jumlah Aplikasi',
            data: @json($topLokasiData),
            backgroundColor: '#06b6d4',
            borderRadius: 4,
            barThickness: 30
        }]
    },
    options: {
        indexAxis: 'y', // <-- ini membuat bar horizontal
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.parsed.x + ' Aplikasi';
                    }
                }
            }
        }
    }
});

    </script>
    @endpush
</x-app-layout>
