
@extends('admin.template')

@section('content')

<!-- STYLE TAMBAHAN UNTUK TAMPILAN MODERN & ANIMASI -->
<style>
    /* Font & Body Reset */
    .dashboard-wrapper h4 {
        font-weight: 700;
        color: #344767;
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
        background: #17c1e8;
        border-radius: 4px;
    }

    /* --- KARTU STATISTIK DENGAN GELOMBANG --- */
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* Warna Background Gradient */
    .bg-karyawan { background: linear-gradient(135deg, #17c1e8 0%, #00acc1 100%); }
    .bg-gaji { background: linear-gradient(135deg, #fbc02d 0%, #f9a825 100%); color: #333; } /* Text gelap agar kontras di kuning */
    .bg-total { background: linear-gradient(135deg, #e53935 0%, #c62828 100%); }

    /* Icon Circle */
    .icon-circle {
        background: rgba(255,255,255,0.2);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        font-size: 24px;
        backdrop-filter: blur(2px);
        z-index: 2;
    }

    .bg-gaji .icon-circle { background: rgba(0,0,0,0.05); }

    /* Text Styles */
    .stat-value { font-size: 28px; font-weight: 700; z-index: 2; }
    .stat-label { font-size: 13px; font-weight: 500; opacity: 0.9; z-index: 2; text-transform: uppercase; letter-spacing: 1px; }

    /* --- ANIMASI GELOMBANG (WAVES) --- */
    .waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        overflow: hidden;
        z-index: 1;
    }

    .parallax > use {
        animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
    }
    .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255,255,255,0.7); }
    .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255,255,255,0.5); }
    .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255,255,255,0.3); }
    .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #fff; }

    @keyframes move-forever {
        0% { transform: translate3d(-90px,0,0); }
        100% { transform: translate3d(85px,0,0); }
    }

    /* --- CONTENT BOX (CHART & LIST) --- */
    .modern-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        height: 100%;
    }

    .card-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
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
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
    }
    .status-item:last-child { border-bottom: none; }

    .status-name { font-weight: 500; color: #555; }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-success { background-color: #e6fffa; color: #047481; }
    .badge-danger { background-color: #fff5f5; color: #c53030; }

    /* Scrollbar custom */
    .status-list-container::-webkit-scrollbar { width: 5px; }
    .status-list-container::-webkit-scrollbar-thumb { background: #ddd; border-radius: 5px; }
</style>

<div class="container-fluid dashboard-wrapper">

    <h4>Dashboard</h4>

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
                        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(0,0,0,0.1)" />
                        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(0,0,0,0.1)" />
                        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(0,0,0,0.1)" />
                        <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
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
                <div class="card-title" style="color: #17c1e8;">
                    <i class="fas fa-chart-pie"></i> Grafik Komposisi Gaji
                </div>
                <div style="display:flex;justify-content:center; position: relative; height: 250px;">
                    <canvas id="grafikKomposisiGaji"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Gaji Karyawan -->
        <div class="col-md-6">
            <div class="modern-card">
                <div class="card-title" style="color: #f9a825;">
                    <i class="fas fa-list-check"></i> Status Gaji Karyawan
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

// Konfigurasi Chart agar lebih modern
new Chart(document.getElementById('grafikKomposisiGaji'), {
    type: 'doughnut', // Ubah menjadi donat agar lebih elegan dari pie biasa
    data: {
        labels: ['Gaji Pokok','Tunjangan','Potongan'],
        datasets: [{
            data: komposisi,
            backgroundColor: [
                '#17c1e8', // Sesuaikan dengan warna kartu karyawan
                '#fbc02d', // Sesuaikan dengan warna kartu gaji
                '#e53935'  // Sesuaikan dengan warna kartu total
            ],
            borderWidth: 0,
            hoverOffset: 5
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
                    padding: 20,
                    font: {
                        family: "'Poppins', sans-serif", // Pastikan font sesuai atau hapus baris ini
                        size: 12
                    }
                }
            }
        },
        cutout: '70%', // Ukuran lubang tengah donat
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
});
</script>

@endsection
```
