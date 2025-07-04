<x-app-layout>
     <x-slot name="header">
        Dashboard
    </x-slot>
    <div class="container-fluid">
        <div class="row g-4 mb-4 mt-2">
            <!-- Card Section -->
            @foreach ([
                ['icon' => 'fas fa-building', 'color' => 'text-primary', 'value' => 18, 'label' => 'Jumlah Unit'],
                ['icon' => 'fas fa-folder', 'color' => 'text-warning', 'value' => 36, 'label' => 'Total Aplikasi'],
                ['icon' => 'fas fa-check-circle', 'color' => 'text-success', 'value' => 20, 'label' => 'Aplikasi Aktif'],
                ['icon' => 'fas fa-times-circle', 'color' => 'text-danger', 'value' => 20, 'label' => 'Aplikasi Nonaktif']
            ] as $card)
                <div class="col-md-3">
                    <div class="card-custom">
                        <div class="icon-container {{ $card['color'] }}"><i class="{{ $card['icon'] }}"></i></div>
                        <div>
                            <div class="card-value">{{ $card['value'] }}</div>
                            <div class="card-label">{{ $card['label'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Charts -->
        <div class="row g-4">
            <div class="col-md-8">
                <div class="chart-card">
                    <h5>Jumlah Aplikasi per Unit</h5>
                    <div class="chart-wrapper">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-card">
                    <h5>Todo List</h5>
                    <ul class="list-unstyled">
                        @foreach (['APK 1', 'APK 2', 'APK 3', 'APK 4', 'APK 5'] as $item)
                            <li class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ $item }}">
                                <label class="form-check-label" for="{{ $item }}">{{ $item }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="chart-card">
                    <h5>Perbandingan Item</h5>
                    <div class="chart-wrapper large">
                        <canvas id="barChart"></canvas>
                    </div>
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