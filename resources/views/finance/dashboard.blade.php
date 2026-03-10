@extends('finance.template')

@section('content')

<style>
    :root {
        --maroon-primary: #800000;
        --maroon-hover: #990000;
    }

    /* Mencegah layout shift (ukuran berubah) */
    body {
        overflow-x: hidden;
    }

    /* --- STYLE KARTU STATISTIK --- */
    .card-maroon {
        background: var(--maroon-primary);
        color: white;
        border-radius: 15px;
        overflow: hidden; /* Penting agar ombak tidak keluar */
        position: relative;
        box-shadow: 0 4px 15px rgba(128, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek Hover Halus (Tidak merubah ukuran signifikan) */
    .card-maroon:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(128, 0, 0, 0.3);
    }

    /* --- ANIMASI GELOMBANG (DIPERBAIKI) --- */
    .wave-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        z-index: 1;
        pointer-events: none; /* Agar tidak mengganggu klik */
    }

    .wave {
        position: absolute;
        width: 200%;
        height: 100%;
        bottom: 0;
        left: 0;
        background: url("https://svgshare.com/i/uYk.svg");
        background-size: 50% 100%;
        animation: waveMove 10s linear infinite; /* Diperlambat sedikit agar lebih smooth */
    }

    .wave:nth-child(2) {
        opacity: 0.5;
        animation: waveMove 7s linear infinite reverse;
        bottom: 5px;
    }

    .wave:nth-child(3) {
        opacity: 0.3;
        animation: waveMove 5s linear infinite;
        bottom: 10px;
    }

    @keyframes waveMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* --- STYLE GRAFIK & LIST --- */
    .card-chart {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-top: 4px solid var(--maroon-primary);
        transition: transform 0.3s ease;
        background: white;
        height: 100%; /* Pastikan tinggi penuh */
        display: flex;
        flex-direction: column;
    }

    .card-chart:hover {
        transform: translateY(-3px);
    }

    /* Container Grafik dengan tinggi tetap agar tidak melompat */
    .chart-container {
        position: relative;
        height: 250px; /* Tinggi tetap */
        width: 100%;
    }

    /* List Styling */
    .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    /* Animasi Masuk Halaman (Fade In) */
    .fade-in {
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    @keyframes fadeIn {
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Wrapper dengan animasi fade-in -->
<div class="fade-in">

    <div class="d-flex justify-content-between mb-4 align-items-center">
        <h2 class="fw-bold" style="color: #800000;">Dashboard SmartGaji</h2>
        <span class="text-muted">Analisis Keuangan</span>
    </div>

    <!-- ROW 1: KARTU STATISTIK -->
    <div class="row g-4 mb-4">

        <!-- Kartu Total Tunjangan -->
        <div class="col-md-6">
            <div class="card card-maroon">
                <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                    <div>
                        <h6 class="text-uppercase opacity-75">Total Tunjangan</h6>
                        <h2 class="fw-bold mb-0">
                            Rp {{ number_format($total_tunjangan ?? 0, 0, ',', '.') }}
                        </h2>
                    </div>
                    <i class="fas fa-hand-holding-usd fa-3x opacity-50"></i>
                </div>
                <div class="wave-container">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>

        <!-- Kartu Total Gaji -->
        <div class="col-md-6">
            <div class="card card-maroon">
                <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                    <div>
                        <h6 class="text-uppercase opacity-75">Total Gaji</h6>
                        <h2 class="fw-bold mb-0">
                            Rp {{ number_format($total_gaji ?? 0, 0, ',', '.') }}
                        </h2>
                    </div>
                    <i class="fas fa-wallet fa-3x opacity-50"></i>
                </div>
                <div class="wave-container">
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 2: GRAFIK & LIST -->
    <div class="row g-4">

        <!-- Kiri: Grafik Tunjangan & List -->
        <div class="col-md-6">
            <div class="card card-chart p-3">
                <h5 class="fw-bold mb-3" style="color: var(--maroon-primary);">Grafik Tunjangan</h5>

                <!-- Container Grafik dengan Tinggi Tetap -->
                <div class="chart-container mb-3">
                    <canvas id="chartTunjangan"></canvas>
                </div>

                <h6 class="fw-bold mt-2 text-secondary text-uppercase" style="font-size: 0.85rem;">Jenis Tunjangan</h6>
                <div style="max-height: 200px; overflow-y: auto; padding-right: 5px;">
                    <!-- Scroll jika item terlalu banyak -->
                    <ul class="list-group list-group-flush">
                        @foreach($jenis_tunjangan ?? [] as $t)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="fw-bold text-dark">{{ $t->nama_tunjangan }}</span>
                            <span class="text-danger fw-bold">Rp {{ number_format($t->nominal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                        @if(empty($jenis_tunjangan))
                        <li class="list-group-item text-center text-muted">Tidak ada data tunjangan</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kanan: Grafik Gaji -->
        <div class="col-md-6">
            <div class="card card-chart p-3">
                <h5 class="fw-bold mb-3" style="color: var(--maroon-primary);">Grafik Gaji Bulanan</h5>

                <!-- Container Grafik dengan Tinggi Tetap -->
                <div class="chart-container">
                    <canvas id="chartGaji"></canvas>
                </div>
            </div>
        </div>

    </div>

</div> <!-- End Fade In -->

<!-- SCRIPT CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Konfigurasi Global untuk Font
    Chart.defaults.font.family = "'Segoe UI', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#666';

    // --- GRAFIK TUNJANGAN ---
    const labelsTunjangan = @json($labels_tunjangan ?? []);
    const valuesTunjangan = @json($values_tunjangan ?? []);

    const ctxTunjangan = document.getElementById('chartTunjangan');

    if (ctxTunjangan) {
        new Chart(ctxTunjangan, {
            type: 'bar',
            data: {
                labels: labelsTunjangan,
                datasets: [{
                    label: 'Total Tunjangan',
                    data: valuesTunjangan,
                    backgroundColor: 'rgba(128, 0, 0, 0.7)',
                    borderColor: '#800000',
                    borderWidth: 1,
                    borderRadius: 5,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // PENTING: Agar ukuran tetap pas, tidak melompat
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 2], color: '#f0f0f0' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // --- GRAFIK GAJI ---
    const labelsGaji = @json($labels_gaji ?? []);
    const valuesGaji = @json($values_gaji ?? []);

    const ctxGaji = document.getElementById('chartGaji');

    if (ctxGaji) {
        new Chart(ctxGaji, {
            type: 'line',
            data: {
                labels: labelsGaji,
                datasets: [{
                    label: 'Total Gaji',
                    data: valuesGaji,
                    borderColor: '#800000',
                    backgroundColor: 'rgba(128, 0, 0, 0.1)',
                    fill: true,
                    tension: 0.4, // Membuat garis melengkung halus
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#800000',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // PENTING: Agar ukuran tetap pas
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#800000',
                        padding: 10,
                        cornerRadius: 5
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false, // Karena nilai gaji besar (jutaan), mulai dari 0 akan membuat garis terlihat datar
                        grid: { borderDash: [2, 2], color: '#f0f0f0' }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    }
</script>

@endsection
