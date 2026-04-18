@extends('finance.template')

@section('content')

<style>
    :root {
        --maroon-primary: #800000;
        --maroon-dark: #5c0000;
        --brown-dark: #3e2723;
        --bg-light: #f8f9fa;
    }

    body {
        overflow-x: hidden;
    }

    /* --- 1. STYLE KARTU STATISTIK --- */
    .card-maroon {
        background: linear-gradient(135deg, #800000 0%, #5d1010 60%, #3e2723 100%);
        color: white;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 25px rgba(62, 39, 35, 0.4);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.27), box-shadow 0.4s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .card-maroon:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 35px rgba(62, 39, 35, 0.6);
    }

    .wave-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 70px;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }

    .wave {
        position: absolute;
        width: 200%;
        height: 100%;
        bottom: 0;
        left: 0;
        background: url("https://svgshare.com/i/uYk.svg");
        background-size: 50% 100%;
        opacity: 0.15;
        animation: waveMove 12s linear infinite;
    }

    .wave:nth-child(2) {
        opacity: 0.1;
        animation: waveMove 8s linear infinite reverse;
        bottom: 5px;
    }

    @keyframes waveMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* --- 2. ANIMASI MASUK UTAMA --- */
    @keyframes slideUpFade {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* Animasi Khusus List Item (Staggered Effect) */
    @keyframes slideInRight {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .animate-item {
        opacity: 0;
        animation-fill-mode: forwards;
        animation-name: slideUpFade;
        animation-duration: 0.8s;
        animation-timing-function: cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.4s; }

    /* --- 3. STYLE KARTU BARU --- */
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border-top: 5px solid var(--maroon-primary);
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }

    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .component-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .component-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #eee;
        transition: all 0.2s ease;
        opacity: 0; /* Mulai tersembunyi untuk animasi */
        animation-name: slideInRight;
        animation-duration: 0.5s;
        animation-fill-mode: forwards;
        gap: 10px;
    }

    /* Delay untuk tiap item list agar muncul berurutan */
    .component-item:nth-child(1) { animation-delay: 0.5s; }
    .component-item:nth-child(2) { animation-delay: 0.6s; }
    .component-item:nth-child(3) { animation-delay: 0.7s; }
    .component-item:nth-child(4) { animation-delay: 0.8s; }
    .component-item:nth-child(5) { animation-delay: 0.9s; }
    .component-item:nth-child(n+6) { animation-delay: 1.0s; }

    .component-item:last-child {
        border-bottom: none;
    }

    .component-item:hover {
        background-color: #fff5f5;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 8px;
        border-bottom-color: transparent;
    }

    .comp-info h6 {
        margin: 0;
        font-weight: 700;
        color: #333;
        font-size: 0.95rem;
    }

    .comp-info small {
        color: #888;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .comp-amount {
        font-weight: 700;
        color: var(--maroon-primary);
        font-size: 1rem;
        white-space: nowrap;
    }

    .comp-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        background-color: #fff0f0;
        color: var(--maroon-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.1rem;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* =========================================
       RESPONSIF DASHBOARD
       ========================================= */

    /* Tablet */
    @media (max-width: 991px) {
        .chart-wrapper {
            height: 260px;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        /* Header dashboard */
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 6px;
        }

        .dashboard-header h2 {
            font-size: 1.25rem;
        }

        .dashboard-header .text-muted {
            font-size: 0.8rem;
        }

        /* Ukuran angka counter di kartu statistik */
        .card-maroon .card-body h2 {
            font-size: 1.15rem;
        }

        .card-maroon .card-body h6 {
            font-size: 0.7rem;
        }

        /* Icon lingkaran di kartu statistik */
        .card-maroon .bg-opacity-20 {
            padding: 10px !important;
            font-size: 1.2rem !important;
        }

        /* Tinggi chart lebih kecil */
        .chart-wrapper {
            height: 220px;
        }

        /* Item komponen tunjangan */
        .component-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 12px 8px;
        }

        .comp-amount {
            font-size: 0.9rem;
            padding-left: 55px;
        }

        .comp-info h6 {
            font-size: 0.85rem;
        }
    }

    /* Mobile kecil */
    @media (max-width: 400px) {
        .chart-wrapper {
            height: 190px;
        }

        .card-maroon .card-body h2 {
            font-size: 1rem;
        }
    }
</style>

<!-- Wrapper Utama -->
<div class="fade-in p-2">

    <!-- Header -->
    <div class="d-flex justify-content-between mb-4 align-items-center animate-item dashboard-header" style="animation-delay: 0s;">
        <h2 class="fw-bold" style="color: #800000; position: relative; display: inline-block;">
            Dashboard Finance
            <span style="display:block; width: 50%; height: 3px; background: linear-gradient(to right, #800000, #3e2723); margin-top: 5px; border-radius: 2px;"></span>
        </h2>
        <span class="text-muted fw-light"><i class="fas fa-chart-pie me-2"></i>Analisis Keuangan</span>
    </div>

    <!-- ROW 1: KARTU STATISTIK -->
    <div class="animate-item delay-1">
        <div class="row g-4 mb-4">
            <!-- Total Tunjangan -->
            <div class="col-sm-6 col-md-6">
                <div class="card card-maroon h-100">
                    <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                        <div>
                            <h6 class="text-uppercase opacity-75 mb-1">Total Tunjangan</h6>
                            <!-- Tambahkan class counter-up untuk animasi angka -->
                            <h2 class="fw-bold mb-0 counter-up" data-target="{{ $total_tunjangan ?? 0 }}">
                                Rp 0
                            </h2>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle"><i class="fas fa-hand-holding-usd fa-2x text-white"></i></div>
                    </div>
                    <div class="wave-container"><div class="wave"></div><div class="wave"></div></div>
                </div>
            </div>
            <!-- Total Gaji -->
            <div class="col-sm-6 col-md-6">
                <div class="card card-maroon h-100">
                    <div class="card-body d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                        <div>
                            <h6 class="text-uppercase opacity-75 mb-1">Total Gaji</h6>
                            <!-- Tambahkan class counter-up untuk animasi angka -->
                            <h2 class="fw-bold mb-0 counter-up" data-target="{{ $total_gaji ?? 0 }}">
                                Rp 0
                            </h2>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle"><i class="fas fa-wallet fa-2x text-white"></i></div>
                    </div>
                    <div class="wave-container"><div class="wave"></div><div class="wave"></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 2: TAMPILAN MANUAL (POSISI DITUKAR) -->
    <div class="animate-item delay-2">
        <div class="row g-4">

            <!-- KIRI: GRAFIK ANALISIS GAJI (SEKARANG DI KIRI, col-md-7) -->
            <div class="col-md-7">
                <div class="card card-custom p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="fw-bold m-0" style="color: var(--maroon-primary);">Analisis Gaji Bulanan</h5>
                            <small class="text-muted fw-light">Arus Kas Gaji Bulanan</small>
                        </div>
                    </div>

                    <div class="chart-wrapper">
                        <canvas id="chartGajiManual"></canvas>
                    </div>
                </div>
            </div>

            <!-- KANAN: DAFTAR KOMPONEN TUNJANGAN (SEKARANG DI KANAN, col-md-5) -->
            <div class="col-md-5">
                <div class="card card-custom p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="fw-bold m-0" style="color: var(--maroon-primary);">Komponen Tunjangan</h5>
                            <small class="text-muted">Rincian aktif saat ini</small>
                        </div>
                        <i class="fas fa-list-ul text-muted opacity-50"></i>
                    </div>

                    <ul class="component-list">
                        @forelse($tunjangan_list as $t)
                            <li class="component-item">
                                <div class="d-flex align-items-center">
                                    <div class="comp-icon">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                    <div class="comp-info">
                                        <h6>{{ ucfirst($t->nama_tunjangan) }}</h6>
                                        <small>Aktif</small>
                                    </div>
                                </div>
                                <span class="comp-amount">
                                    Rp {{ number_format($t->total,0,',','.') }}
                                </span>
                            </li>
                        @empty
                            <li class="component-item">
                                <div class="d-flex align-items-center">
                                    <div class="comp-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="comp-info">
                                        <h6>Belum ada data tunjangan</h6>
                                        <small>Silakan tambah data tunjangan</small>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>

                </div>
            </div>

        </div>
    </div>

</div>

<!-- SCRIPT CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.font.family = "'Segoe UI', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#555';

    // --- DATA GRAFIK (Logika Tetap) ---
    const labelsGaji = @json($labels_gaji);
    const valuesGaji = @json($values_gaji);
    const labelsTunjangan = @json($labels_tunjangan);
    const valuesTunjangan = @json($values_tunjangan);

    // Fallback data jika kosong
    if(labelsGaji.length === 0){
        labelsGaji.push('Januari','Februari','Maret','April','Mei','Juni');
    }
    if(valuesGaji.length === 0){
        valuesGaji.push(85000000,87000000,86000000,89000000,88200000,91000000);
    }

    // --- ANIMASI COUNTER UP (Angka Berjalan) ---
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            // Format angka ke Rupiah
            const currentVal = Math.floor(progress * (end - start) + start);
            obj.innerHTML = "Rp " + currentVal.toLocaleString('id-ID');

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                 // Pastikan angka akhir pas
                 obj.innerHTML = "Rp " + end.toLocaleString('id-ID');
            }
        };
        window.requestAnimationFrame(step);
    }

    // Jalankan animasi counter untuk semua elemen .counter-up
    document.querySelectorAll('.counter-up').forEach(el => {
        const target = parseInt(el.getAttribute('data-target'));
        animateValue(el, 0, target, 2000); // 2000ms durasi
    });

    // --- RENDER CHART ---
    const ctxGaji = document.getElementById('chartGajiManual');

    if (ctxGaji) {
        // Gradient untuk Area Chart
        let gradient = ctxGaji.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(128, 0, 0, 0.4)');
        gradient.addColorStop(1, 'rgba(128, 0, 0, 0.0)');

        new Chart(ctxGaji, {
            type: 'line',
            data: {
                labels: labelsGaji,
                datasets: [{
                    label: 'Arus Kas (Rp)',
                    data: valuesGaji,
                    borderColor: '#800000',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#800000',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#3e2723',
                        padding: 10,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13, weight: 'bold' },
                        cornerRadius: 5,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) { label += ': '; }
                                if (context.parsed.y !== null) {
                                    let value = context.parsed.y;
                                    let formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
                                    return formatted;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: { borderDash: [5, 5], color: '#e0e0e0' },
                        ticks: {
                            callback: function(value) {
                                return value / 1000000 + ' Jt';
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                }
            }
        });
    }
</script>

@endsection
