<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="row">
    @foreach ([
        ['icon' => 'far fa-building',       'color' => 'icon-blue',  'value' => 10, 'label' => 'Total Biaya Aplikasi'],
        ['icon' => 'far fa-folder',           'color' => 'icon-yellow',   'value' => 36, 'label' => 'Total Aplikasi'],
        ['icon' => 'fas fa-check',  'color' => 'icon-green', 'value' => 20, 'label' => 'Aplikasi Aktif'],
        ['icon' => 'fas fa-times',      'color' => 'icon-red', 'value' => 36, 'label' => 'Aplikasi Nonaktif']
    ] as $card)
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
            <div class="col-md-8">
                <div class="chart-card h-100">
                    <h5>Jumlah Aplikasi per Unit</h5>
                    <div class="chart-wrapper">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column">
    <div class="chart-card h-100">
        <h5 class="mb-3">Aplikasi Hampir Expired</h5>
        <ul class="list-unstyled" style="max-height: 200px; overflow-y: auto; padding-left: 0.5rem;">
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">SIPengadaan</div>
                    <div class="col-4 text-center">20 Jul 2025</div>
                    <div class="col-4 text-end">4 hari lagi</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">e-Arsip</div>
                    <div class="col-4 text-center">30 Jul 2025</div>
                    <div class="col-4 text-end">14 hari lagi</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
            <li class="py-2 border-bottom" style="font-size: 0.9rem;">
                <div class="row">
                    <div class="col-4 text-start">Simpeg</div>
                    <div class="col-4 text-center">10 Jul 2025</div>
                    <div class="col-4 text-end">Expired</div>
                </div>
            </li>
        </ul>
    </div>
</div>

        </div>

        <!-- Perbandingan + Samping -->
        <div class="row g-4 mt-2">
            <div class="col-md-8 d-flex flex-column">
                <div class="chart-card">
                    <h5>Perbandingan Item</h5>
                    <div class="chart-wrapper large">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="chart-card">
                    <h5>Aplikasi Terbaru</h5>
                    <p class="mb-2">Aplikasi yang baru saja ditambahkan.</p>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>SIPengadaan</span><span class="text-muted">01 Jul 2025</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Simpeg v2</span><span class="text-muted">29 Jun 2025</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>e-Arsip</span><span class="text-muted">28 Jun 2025</span>
                        </li>
                    </ul>
                </div>
            </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart(document.getElementById('lineChart'), {
                type: 'line',
                data: {
                    labels: ['UNIT 1', 'UNIT 2', 'UNIT 3', 'UNIT 4', 'UNIT 5', 'UNIT 6', 'UNIT 7', 'UNIT 8'],
                    datasets: [{
                        label: 'Jumlah Aplikasi',
                        data: [3, 5, 2, 6, 4, 5, 6, 2],
                        borderColor: 'blue',
                        backgroundColor: 'lightblue',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            new Chart(document.getElementById('barChart'), {
                type: 'bar',
                data: {
                    labels: ['Item 1', 'Item 2'],
                    datasets: [{
                        label: 'Seri 1',
                        data: [3, 8],
                        backgroundColor: '#06b6d4'
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    @endpush
</x-app-layout>