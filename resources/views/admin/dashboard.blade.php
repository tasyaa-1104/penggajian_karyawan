@extends('admin.template')

@section('content')

<!-- STYLE TAMBAHAN UNTUK TAMPILAN MODERN & MAROON ELEGAN -->
<style>
    /* Font & Body Reset */
    .dashboard-wrapper h4 {
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
        position: relative;
        padding-left: 15px;
    }
    .dashboard-wrapper h4::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 24px;
        background: #800000; /* Warna Maroon */
        border-radius: 4px;
    }

    /* --- KARTU STATISTIK (MAROON THEME) --- */
    .stat-card {
        border-radius: 20px;
        height: 180px;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
        box-shadow: 0 10px 30px rgba(128, 0, 0, 0.15); /* Bayangan merah halus */
        margin-bottom: 30px;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(128, 0, 0, 0.25);
    }

    /* 1. Karyawan: Maroon Utama */
    .bg-karyawan {
        background: linear-gradient(135deg, #800000 0%, #5c0000 100%);
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* 2. Gaji Data: Light Maroon/Burgundy */
    .bg-gaji {
        background: linear-gradient(135deg, #9e2a2b 0%, #7a1c1c 100%);
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* 3. Total Gaji: Dark Maroon/Blackish */
    .bg-total {
        background: linear-gradient(135deg, #3d0000 0%, #1a0000 100%);
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* Icon Circle */
    .icon-circle {
        background: rgba(255,255,255,0.15); /* Lebih transparan */
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        font-size: 26px;
        backdrop-filter: blur(5px);
        z-index: 2;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .stat-card:hover .icon-circle {
        transform: rotate(10deg) scale(1.1);
        background: rgba(255,255,255,0.25);
    }

    /* Text Styles */
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        letter-spacing: 1px;
    }
    .stat-label {
        font-size: 13px;
        font-weight: 500;
        opacity: 0.9;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 5px;
    }

    /* --- ANIMASI GELOMBANG (WAVES) --- */
    .waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 80px;
        overflow: hidden;
        z-index: 1;
    }

    .parallax > use {
        animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
    }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.1); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.2); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: rgba(255,255,255,0.4); }

    @keyframes move-forever {
        0% { transform: translate3d(-90px,0,0); }
        100% { transform: translate3d(85px,0,0); }
    }

    /* --- CONTENT BOX (CHART & LIST) --- */
    .modern-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .modern-card:hover {
        transform: translateY(-2px);
    }

    .card-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #800000; /* Judul kartu konten Maroon */
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 10px;
    }

    /* Status List Styling */
    .status-list-container {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        border-bottom: 1px solid #f8f9fa;
        transition: background 0.2s;
        border-radius: 8px;
    }
    .status-item:hover { background: #fff5f5; }
    .status-item:last-child { border-bottom: none; }

    .status-name { font-weight: 500; color: #555; font-size: 14px; }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    /* Badge Colors Disesuaikan */
    .badge-success { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .badge-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    /* Scrollbar custom */
    .status-list-container::-webkit-scrollbar { width: 5px; }
    .status-list-container::-webkit-scrollbar-thumb { background: #ccc; border-radius: 5px; }

    /* --- LOGOUT BUBBLE BUTTON (MAROON STYLE) --- */
    .btn-logout-bubble {
        background: linear-gradient(135deg, #9e2a2b, #5c0000); /* Gradasi Maroon */
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 50px; /* 🔵 bubble */
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(92, 0, 0, 0.3);
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-logout-bubble i {
        font-size: 14px;
    }

    .btn-logout-bubble:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(92, 0, 0, 0.4);
        background: linear-gradient(135deg, #b93233, #6a0a0a);
    }

    .btn-logout-bubble:active {
        transform: scale(0.95);
    }
</style>

<div class="container-fluid dashboard-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Dashboard</h4>

       
    </div>

    <!-- INFO BOX -->
    <div class="row">

        <!-- Total Karyawan -->
        <div class="col-md-4">
            <div class="stat-card bg-karyawan">
                <div class="icon-circle">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">{{ $jumlah_karyawan }}</div>
                <div class="stat-label">Total Karyawan</div>

                <!-- SVG Wave -->
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="48" y="0" />
                        <use xlink:href="#gentle-wave" x="48" y="3" />
                        <use xlink:href="#gentle-wave" x="48" y="5" />
                        <use xlink:href="#gentle-wave" x="48" y="7" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- Total Data Gaji -->
        <div class="col-md-4">
            <div class="stat-card bg-gaji">
                <div class="icon-circle">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-value">{{ $jumlah_gaji }}</div>
                <div class="stat-label">Total Data Gaji</div>

                <!-- SVG Wave -->
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="48" y="0" />
                        <use xlink:href="#gentle-wave" x="48" y="3" />
                        <use xlink:href="#gentle-wave" x="48" y="5" />
                        <use xlink:href="#gentle-wave" x="48" y="7" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- Total Gaji Bulanan -->
        <div class="col-md-4">
            <div class="stat-card bg-total">
                <div class="icon-circle">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-value" style="font-size: 22px;">
                    Rp {{ number_format($total_gaji_bulan,0,',','.') }}
                </div>
                <div class="stat-label">Total Gaji Bulanan</div>

                <!-- SVG Wave -->
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="48" y="0" />
                        <use xlink:href="#gentle-wave" x="48" y="3" />
                        <use xlink:href="#gentle-wave" x="48" y="5" />
                        <use xlink:href="#gentle-wave" x="48" y="7" />
                    </g>
                </svg>
            </div>
        </div>

    </div>

    <!-- GRAFIK & LIST -->
    <div class="row">

        <!-- Grafik Komposisi Gaji -->
        <div class="col-md-6">
            <div class="modern-card">
                <div class="card-title">
                    <i class="fas fa-chart-pie" style="color: #800000;"></i> Grafik Komposisi Gaji
                </div>
                <div style="display:flex;justify-content:center; position: relative; height: 250px;">
                    <canvas id="grafikKomposisiGaji"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Gaji Karyawan -->
        <div class="col-md-6">
            <div class="modern-card">
                <div class="card-title">
                    <i class="fas fa-list-check" style="color: #800000;"></i> Status Gaji Karyawan
                </div>

                <div class="status-list-container">
                    @foreach($status_karyawan as $row)
                        <div class="status-item">
                            <span class="status-name">{{ $row['nama'] }}</span>

                            @if($row['status'] == 'Dibayar')
                                <span class="badge-custom badge-success">Dibayar</span>
                            @else
                                <span class="badge-custom badge-danger">Belum</span>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const komposisi = @json($komposisi_gaji);

// Konfigurasi Chart Maroon Theme
new Chart(document.getElementById('grafikKomposisiGaji'), {
    type: 'doughnut',
    data: {
        labels: ['Gaji Pokok','Tunjangan','Potongan'],
        datasets: [{
            data: komposisi,
            // Warna Chart disesuaikan dengan tema kartu (Maroon, Light Maroon, Dark Maroon)
            backgroundColor: [
                '#800000', // Sesuai Karyawan
                '#9e2a2b', // Sesuai Data Gaji
                '#3d0000'  // Sesuai Total Gaji
            ],
            borderWidth: 0,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 25,
                    font: {
                        family: "'Poppins', sans-serif",
                        size: 13,
                        weight: '500'
                    },
                    color: '#555'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: { family: 'Poppins', size: 14 },
                bodyFont: { family: 'Poppins', size: 13 }
            }
        },
        cutout: '70%',
        animation: {
            animateScale: true,
            animateRotate: true,
            duration: 1500,
            easing: 'easeOutQuart'
        }
    }
});
</script>

@endsection
