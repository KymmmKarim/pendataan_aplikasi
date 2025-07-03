<x-app-layout>
    <!-- Stat Cards -->
    <div class="row mb-4">
        @php
            $stats = [
                ['icon' => 'fa-building', 'text' => 'Jumlah Unit', 'value' => 18, 'color' => 'primary'],
                ['icon' => 'fa-folder', 'text' => 'Total Aplikasi', 'value' => 36, 'color' => 'warning'],
                ['icon' => 'fa-check-circle', 'text' => 'Aplikasi Aktif', 'value' => 20, 'color' => 'success'],
                ['icon' => 'fa-times-circle', 'text' => 'Aplikasi Nonaktif', 'value' => 20, 'color' => 'danger'],
            ];
        @endphp
        @foreach ($stats as $s)
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 text-{{ $s['color'] }} fs-2"><i class="fas {{ $s['icon'] }}"></i></div>
                        <div>
                            <div class="fs-5 fw-bold">{{ $s['value'] }}</div>
                            <div class="text-muted">{{ $s['text'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Chart & Todo -->
    <div class="row">
        <!-- Line Chart -->
        <div class="col-md-8 mb-4">
            <div class="card shadow">
                <div class="card-header fw-bold">Jumlah Aplikasi per Unit</div>
                <div class="card-body">
                    <canvas id="lineChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Todo List -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header fw-bold">Todo List</div>
                <ul class="list-group list-group-flush">
                    @foreach (['APK 1', 'APK 1', 'APK 1', 'APK 1', 'APK 1'] as $item)
                        <li class="list-group-item">
                            <input type="checkbox" class="form-check-input me-2">{{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header fw-bold">Perbandingan Item</div>
                <div class="card-body">
                    <canvas id="barChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
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
            }
        });

        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Item 1', 'Item 2'],
                datasets: [{
                    label: 'Seri 1',
                    data: [3, 8],
                    backgroundColor: '#0dcaf0'
                }]
            }
        });
    </script>
    @endpush
</x-app-layout>