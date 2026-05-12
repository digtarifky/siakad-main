<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIAkad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-500 mt-2">Statistik Mahasiswa SIAkad</p>
            </div>
            <a href="{{ route('student.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
                &larr; Kembali
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalAktif + $totalLulus }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <p class="text-gray-500 text-sm">Mahasiswa Aktif</p>
                <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalAktif }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <p class="text-gray-500 text-sm">Mahasiswa Lulus</p>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalLulus }}</p>
            </div>
        </div>

        <!-- Row 1: Bar Chart Prodi + Line Chart Angkatan -->
        <div class="grid grid-cols-2 gap-6 mb-6">

            <!-- Bar Chart: Mahasiswa per Prodi -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mahasiswa per Prodi</h2>
                <canvas id="chartProdi"></canvas>
            </div>

            <!-- Line Chart: Mahasiswa per Angkatan -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mahasiswa per Angkatan</h2>
                <canvas id="chartAngkatan"></canvas>
            </div>

        </div>

        <!-- Row 2: Line Chart Lulus + Pie Chart Status -->
        <div class="grid grid-cols-2 gap-6">

            <!-- Line Chart: Mahasiswa Lulus per Angkatan -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mahasiswa Lulus per Angkatan</h2>
                <canvas id="chartLulus"></canvas>
            </div>

            <!-- Pie Chart: Status Aktif vs Lulus -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Perbandingan Status Mahasiswa</h2>
                <canvas id="chartStatus"></canvas>
            </div>

        </div>

    </div>

    <script>
        // Data dari Laravel
        const prodiLabels = @json($mahasiswaPerProdi->pluck('prodi'));
        const prodiData   = @json($mahasiswaPerProdi->pluck('total'));

        const angkatanLabels = @json($mahasiswaPerAngkatan->pluck('angkatan'));
        const angkatanData   = @json($mahasiswaPerAngkatan->pluck('total'));

        const lulusLabels = @json($mahasiswaLulusPerAngkatan->pluck('angkatan'));
        const lulusData   = @json($mahasiswaLulusPerAngkatan->pluck('total'));

        const totalAktif  = {{ $totalAktif }};
        const totalLulus  = {{ $totalLulus }};

        // Bar Chart - Mahasiswa per Prodi
        new Chart(document.getElementById('chartProdi'), {
            type: 'bar',
            data: {
                labels: prodiLabels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: prodiData,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Line Chart - Mahasiswa per Angkatan
        new Chart(document.getElementById('chartAngkatan'), {
            type: 'line',
            data: {
                labels: angkatanLabels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: angkatanData,
                    borderColor: 'rgba(139, 92, 246, 1)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Line Chart - Mahasiswa Lulus per Angkatan
        new Chart(document.getElementById('chartLulus'), {
            type: 'line',
            data: {
                labels: lulusLabels,
                datasets: [{
                    label: 'Mahasiswa Lulus',
                    data: lulusData,
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Pie Chart - Status Aktif vs Lulus
        new Chart(document.getElementById('chartStatus'), {
            type: 'pie',
            data: {
                labels: ['Aktif', 'Lulus'],
                datasets: [{
                    data: [totalAktif, totalLulus],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ]
                }]
            },
            options: { responsive: true }
        });
    </script>

</body>
</html>