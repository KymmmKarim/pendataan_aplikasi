<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="container-fluid">
        <!-- Stat Cards -->
        <div class="row g-4 mb-4 mt-2">
            @foreach ([
                ['icon' => 'fas fa-building',     'color' => 'text-primary', 'value' => 18, 'label' => 'Jumlah Unit'],
                ['icon' => 'fas fa-folder',       'color' => 'text-warning', 'value' => 36, 'label' => 'Total Aplikasi'],
                ['icon' => 'fas fa-check-circle', 'color' => 'text-success', 'value' => 20, 'label' => 'Aplikasi Aktif'],
                ['icon' => 'fas fa-times-circle', 'color' => 'text-danger',  'value' => 20, 'label' => 'Aplikasi Nonaktif']
            ] as $card)
                <div class="col-md-3">
                    <div class="card-custom">
                        <div class="icon-container {{ $card['color'] }}">
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
                    <h5 class="mb-3">Todo List</h5>
                    <ul class="list-unstyled" style="max-height: 150px; overflow-y: auto; padding-left: 0.5rem;">
                        @foreach (['APK 1', 'APK 2', 'APK 3', 'APK 4', 'APK 5', 'APK 6', 'APK 7', 'APK 8'] as $item)
                            <li class="form-check mb-1" style="font-size: 0.9rem;">
                                <input class="form-check-input me-1" type="checkbox" id="{{ $item }}" style="transform: scale(0.9);">
                                <label class="form-check-label" for="{{ $item }}" style="font-weight: 500;">
                                    {{ $item }}
                                </label>
                            </li>
                        @endforeach
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

            <!-- Konten tambahan di samping perbandingan -->
            <div class="col-md-4">
                <div class="chart-card">
                    <h5>Info Ringkasan</h5>
                    <p class="mb-2">Beberapa aplikasi sedang maintenance.</p>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Yang aktif:</span><strong>20</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Nonaktif:</span><strong>20</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total:</span><strong>40</strong>
                        </li>
                    </ul>
                </div>
            </div>
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
