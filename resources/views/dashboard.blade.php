<x-app-layout>
    <div class="container-fluid">
        <div class="row g-4 mb-4 mt-2">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="bg-white rounded shadow-sm p-3 d-flex align-items-center">
                    <div class="me-3 text-primary fs-3"><i class="fas fa-building"></i></div>
                    <div>
                        <div class="fw-bold fs-5">18</div>
                        <div class="text-muted">Jumlah Unit</div>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="bg-white rounded shadow-sm p-3 d-flex align-items-center">
                    <div class="me-3 text-warning fs-3"><i class="fas fa-folder"></i></div>
                    <div>
                        <div class="fw-bold fs-5">36</div>
                        <div class="text-muted">Total Aplikasi</div>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3">
                <div class="bg-white rounded shadow-sm p-3 d-flex align-items-center">
                    <div class="me-3 text-success fs-3"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="fw-bold fs-5">20</div>
                        <div class="text-muted">Aplikasi Aktif</div>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-3">
                <div class="bg-white rounded shadow-sm p-3 d-flex align-items-center">
                    <div class="me-3 text-danger fs-3"><i class="fas fa-times-circle"></i></div>
                    <div>
                        <div class="fw-bold fs-5">20</div>
                        <div class="text-muted">Aplikasi Nonaktif</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4">
            <div class="col-md-8">
                <div class="bg-white rounded shadow-sm p-3">
                    <h5>Jumlah Aplikasi per Unit</h5>
                    <canvas id="lineChart" height="150"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white rounded shadow-sm p-3">
                    <h5>Todo List</h5>
                    <ul class="list-unstyled">
                        @foreach (['APK 1', 'APK 1', 'APK 1', 'APK 1', 'APK 1'] as $item)
                            <li class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ $item }}">
                                <label class="form-check-label" for="{{ $item }}">{{ $item }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="bg-white rounded shadow-sm p-3">
                    <h5>Perbandingan Item</h5>
                    <canvas id="barChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
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
        indexAxis: 'y' // Membuat chart jadi horizontal
    }
});

    </script>
    @endpush
</x-app-layout>