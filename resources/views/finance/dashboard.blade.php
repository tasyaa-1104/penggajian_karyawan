@extends('finance.template')

@section('content')

<!-- CSS Khusus Halaman Dashboard untuk Animasi Gelombang -->
<style>
    :root {
        --maroon-primary: #800000;
        --maroon-light: #a52a2a;
    }

    .card-maroon {
        background-color: var(--maroon-primary);
        color: white;
        border: none;
        border-radius: 15px;
        overflow: hidden; /* Penting untuk memotong gelombang */
        position: relative;
        box-shadow: 0 4px 15px rgba(128, 0, 0, 0.4);
        transition: transform 0.3s ease;
    }

    .card-maroon:hover {
        transform: translateY(-5px);
    }

    /* --- ANIMASI GELOMBANG (WAVE) --- */
    .wave-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50px;
        overflow: hidden;
    }

    .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800v-.2-31.6z' fill='%23ffffff' fill-opacity='0.2'/%3E%3C/svg%3E");
        background-size: 50% 100%;
        animation: wave-animation 10s linear infinite;
    }

    .wave:nth-child(2) {
        bottom: 5px;
        opacity: 0.5;
        animation: wave-animation 7s linear infinite reverse;
    }

    .wave:nth-child(3) {
        bottom: 10px;
        opacity: 0.7;
        animation: wave-animation 5s linear infinite;
    }

    @keyframes wave-animation {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .card-chart {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-top: 4px solid var(--maroon-primary);
    }
</style>

<!-- Judul Dashboard -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: var(--maroon-primary);">Dashboard SmartGaji</h2>
    <span class="text-muted">Analisis Keuangan & Tunjangan</span>
</div>

<!-- ROW 1: 2 KARTU STATISTIK (MAROON + GELOMBANG) -->
<div class="row g-4 mb-4">

    <!-- Kartu 1: Total Tunjangan -->
    <div class="col-md-6">
        <div class="card card-maroon h-100">
            <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                <div>
                    <h6 class="text-uppercase opacity-75">Total Tunjangan</h6>
                    <h2 class="fw-bold mb-0">
                        Rp {{ number_format($total_tunjangan ?? 0, 0, ',', '.') }}
                    </h2>
                    <small class="mt-2 d-block opacity-75">
                        <i class="fas fa-chart-line me-1"></i> Bulan Ini
                    </small>
                </div>
                <div class="icon-bg">
                    <i class="fas fa-hand-holding-usd fa-4x opacity-50"></i>
                </div>
            </div>
            <div class="wave-container">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
        </div>
    </div>

    <!-- Kartu 2: Total Gaji -->
    <div class="col-md-6">
        <div class="card card-maroon h-100">
            <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                <div>
                    <h6 class="text-uppercase opacity-75">Total Gaji Karyawan</h6>
                    <h2 class="fw-bold mb-0">
                        Rp {{ number_format($total_gaji ?? 0, 0, ',', '.') }}
                    </h2>
                    <small class="mt-2 d-block opacity-75">
                        <i class="fas fa-money-bill-wave me-1"></i> Bulan Ini
                    </small>
                </div>
                <div class="icon-bg">
                    <i class="fas fa-wallet fa-4x opacity-50"></i>
                </div>
            </div>
            <div class="wave-container">
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
        </div>
    </div>

</div>

<!-- ROW 2: GRAFIK ANALISIS (CHART.JS) -->
<div class="row g-4">
    <!-- Grafik Tunjangan -->
    <div class="col-md-6">
        <div class="card card-chart h-100 p-3">
            <h5 class="fw-bold mb-3" style="color: var(--maroon-primary);">Analisis Tunjangan</h5>
            <div style="height: 300px; width: 100%;">
                <canvas id="chartTunjangan"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Gaji -->
    <div class="col-md-6">
        <div class="card card-chart h-100 p-3">
            <h5 class="fw-bold mb-3" style="color: var(--maroon-primary);">Analisis Gaji Bulanan</h5>
            <div style="height: 300px; width: 100%;">
                <canvas id="chartGaji"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT CHART JS DIPINDAHKAN KE SINI AGAR PASTI JALAN -->
<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- 1. GRAFIK TUNJANGAN ---
    const ctxTunjangan = document.getElementById('chartTunjangan').getContext('2d');

    // Data Chart (Gunakan data dummy 0 jika kosong)
    const labelsTunjangan = {{ isset($labels_tunjangan) ? json_encode($labels_tunjangan) : '["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"]' }};
    const dataTunjangan = {{ isset($values_tunjangan) ? json_encode($values_tunjangan) : '[0, 0, 0, 0, 0, 0]' }};

    new Chart(ctxTunjangan, {
        type: 'bar',
        data: {
            labels: labelsTunjangan,
            datasets: [{
                label: 'Nominal Tunjangan',
                data: dataTunjangan,
                backgroundColor: 'rgba(128, 0, 0, 0.7)',
                borderColor: 'rgba(128, 0, 0, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // --- 2. GRAFIK GAJI ---
    const ctxGaji = document.getElementById('chartGaji').getContext('2d');

    const labelsGaji = {{ isset($labels_gaji) ? json_encode($labels_gaji) : '["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"]' }};
    const dataGaji = {{ isset($values_gaji) ? json_encode($values_gaji) : '[0, 0, 0, 0, 0, 0]' }};

    new Chart(ctxGaji, {
        type: 'line',
        data: {
            labels: labelsGaji,
            datasets: [{
                label: 'Tren Gaji',
                data: dataGaji,
                fill: true,
                backgroundColor: 'rgba(128, 0, 0, 0.1)',
                borderColor: '#800000',
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#800000',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
