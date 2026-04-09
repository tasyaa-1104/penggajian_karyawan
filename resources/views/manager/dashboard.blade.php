{{-- @extends('manager.template')

@section('content')

<h3 class="mb-4">Dashboard Manager</h3>

<div class="row g-4">

<div class="col-md-3">
<div class="card bg-primary text-white shadow">
<div class="card-body">
<h6>Total Karyawan</h6>
<h3>{{ $jumlah_karyawan }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-warning text-white shadow">
<div class="card-body">
<h6>Cuti Pending</h6>
<h3>{{ $cuti_pending }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Cuti Disetujui</h6>
<h3>{{ $cuti_disetujui ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Cuti Ditolak</h6>
<h3>{{ $cuti_ditolak ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-secondary text-white shadow">
<div class="card-body">
<h6>Lembur Pending</h6>
<h3>{{ $overtime_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-info text-white shadow">
<div class="card-body">
<h6>Lembur Disetujui</h6>
<h3>{{ $overtime_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Lembur Ditolak</h6>
<h3>{{ $overtime_rejected ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-dark text-white shadow">
<div class="card-body">
<h6>Absensi Hari Ini</h6>
<h3>{{ $absensi_hari_ini ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Izin Pending</h6>
<h3>{{ $izin_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Izin Disetujui</h6>
<h3>{{ $izin_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Izin Ditolak</h6>
<h3>{{ $izin_rejected ?? 0 }}</h3>
</div>
</div>
</div>


<div class="col-md-3">
<div class="card bg-warning text-white shadow">
<div class="card-body">
<h6>Sakit Pending</h6>
<h3>{{ $sakit_pending ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white shadow">
<div class="card-body">
<h6>Sakit Disetujui</h6>
<h3>{{ $sakit_approved ?? 0 }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<h6>Sakit Ditolak</h6>
<h3>{{ $sakit_rejected ?? 0 }}</h3>
</div>
</div>
</div>

</div>

@endsection --}}
{{-- @extends('manager.template')

@section('title', 'Dashboard Manager')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

    .page-title-section {
        background: linear-gradient(135deg, #FFF5F5 0%, #FEE2E2 100%);
        border-left: 5px solid #9B1C20;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .page-title {
        color: #9B1C20;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 3px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }


    .stat-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.12);
    }

    .stat-card .card-body {
        padding: 16px 18px;
    }

    .stat-card .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .stat-card .stat-label {
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 2px;
        opacity: 0.9;
    }

    .stat-card .stat-value {
        font-size: 26fr;
        font-weight: 700;
        margin: 0;
    }


    .card-total {
        background: linear-gradient(135deg, #9B1C20 0%, #B91C1C 100%);
        color: white;
    }


    .card-absensi {
        background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
        color: white;
    }


    .card-pending {
        background: linear-gradient(135deg, #EA580C 0%, #F97316 100%);
        color: white;
    }


    .card-approved {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: white;
    }


    .card-rejected {
        background: linear-gradient(135deg, #BE123C 0%, #E11D48 100%);
        color: white;
    }
</style>

<div class="container-fluid mt-3">

    <div class="page-title-section">
        <h3 class="page-title">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Manager
        </h3>
        <p class="page-subtitle">Ringkasan data karyawan</p>
    </div>


    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card card-total">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Total Karyawan</p>
                        <h3 class="stat-value">{{ $jumlah_karyawan }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card stat-card card-absensi">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Absensi Hari Ini</p>
                        <h3 class="stat-value">{{ $absensi_hari_ini ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Pending</p>
                        <h3 class="stat-value">{{ $cuti_pending }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Disetujui</p>
                        <h3 class="stat-value">{{ $cuti_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Cuti Ditolak</p>
                        <h3 class="stat-value">{{ $cuti_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Pending</p>
                        <h3 class="stat-value">{{ $overtime_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Disetujui</p>
                        <h3 class="stat-value">{{ $overtime_approved ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Lembur Ditolak</p>
                        <h3 class="stat-value">{{ $overtime_rejected ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Pending</p>
                        <h3 class="stat-value">{{ $izin_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Disetujui</p>
                        <h3 class="stat-value">{{ $izin_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Izin Ditolak</p>
                        <h3 class="stat-value">{{ $izin_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <div class="col-md-4">
            <div class="card stat-card card-pending">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Pending</p>
                        <h3 class="stat-value">{{ $sakit_pending ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-approved">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Disetujui</p>
                        <h3 class="stat-value">{{ $sakit_disetujui ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card card-rejected">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-2">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Sakit Ditolak</p>
                        <h3 class="stat-value">{{ $sakit_ditolak ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection --}}
@extends('manager.template')

@section('title', 'Dashboard Manager')

@section('content')

<!-- FontAwesome & Chart.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .page-title-section {
        background: linear-gradient(135deg, #FFF5F5 0%, #FEE2E2 100%);
        border-left: 5px solid #9B1C20;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .page-title {
        color: #9B1C20;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 3px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    .section-header {
        font-size: 14px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 10px;
        margin-top: 25px;
        padding-bottom: 5px;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
    }

    .section-header i {
        margin-right: 8px;
        color: #9B1C20;
    }

    .stat-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .stat-card .card-body {
        padding: 18px;
    }

    .stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        background: rgba(255,255,255,0.2);
        color: white;
        margin-bottom: 10px;
    }

    .stat-card .stat-label {
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 2px;
        opacity: 0.9;
    }

    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 700;
        line-height: 1.1;
    }

    .stat-card .stat-sub {
        font-size: 11px;
        opacity: 0.8;
        margin-top: 4px;
    }

    .card-total {
        background: linear-gradient(135deg, #9B1C20 0%, #B91C1C 100%);
        color: white;
    }

    .card-overtime {
        background: linear-gradient(135deg, #0284C7 0%, #0EA5E9 100%);
        color: white;
    }

    .card-chart {
        background: white;
        border: 1px solid #e5e7eb;
    }

    .card-chart .card-header {
        background: transparent;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 600;
        color: #374151;
    }

    /* Custom Legend */
    .custom-legend {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #4b5563;
    }
    .custom-legend span {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        display: inline-block;
    }
</style>

<div class="container-fluid mt-3">

    <div class="page-title-section">
        <h3 class="page-title">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Manager
        </h3>
        <p class="page-subtitle">Ringkasan data karyawan dan kehadiran harian</p>
    </div>

    {{-- ROW 1: TOTAL KARYAWAN & LEMBUR --}}
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card stat-card card-total h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Total Karyawan</p>
                            <h3 class="stat-value">{{ $jumlah_karyawan }}</h3>
                            <p class="stat-sub">Orang</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card stat-card card-overtime h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label">Lembur Disetujui</p>
                            <h3 class="stat-value">{{ $overtime_approved ?? 0 }}</h3>
                            <p class="stat-sub">Pengajuan</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-business-time"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION: GRAFIK KEHADIRAN HARIAN --}}
    <div class="section-header mt-4">
        <i class="fas fa-chart-bar"></i> Detail Kehadiran Bulan Ini
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="card stat-card card-chart">
                <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>Jumlah Karyawan per Status Harian</span>
                    <div class="custom-legend">
                        {{-- <span><span class="legend-dot" style="background-color: #3B82F6;"></span> Masuk</span> --}}
                        {{-- <span><span class="legend-dot" style="background-color: #F97316;"></span> Cuti</span> --}}
                        <span><span class="legend-dot" style="background-color: #10B981;"></span> Izin</span>
                        <span><span class="legend-dot" style="background-color: #EF4444;"></span> Sakit</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="kehadiranChart" height="130"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const totalKaryawan = {{ $jumlah_karyawan }};
    const rawData = @json($chartAbsensi);

    const labels = [];
    // const dataCutiPercent = [];
    const dataIzinPercent = [];
    const dataSakitPercent = [];
    
    // Simpan angka asli untuk ditampilkan di tooltip
    // const dataCutiReal = [];
    const dataIzinReal = [];
    const dataSakitReal = [];

    // Nama bulan dalam Bahasa Indonesia
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    // Ambil tanggal hari ini
    const now = new Date();
    const year = now.getFullYear();
    const monthIndex = now.getMonth();
    const todayDate = now.getDate();

    // Looping dari tanggal 1 sampai hari ini
    for(let d = 1; d <= todayDate; d++) {
        let dateStr = `${year}-${String(monthIndex + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
        labels.push(d + ' ' + months[monthIndex]);

        // Cari data dari database
        let found = rawData.find(item => item.tanggal === dateStr);

        // Jika ada data, ambil jumlahnya. Jika tidak ada (libur/belum ada data), anggap 0.
        // let cuti = found ? found.cuti : 0;
        let izin = found ? found.izin : 0;
        let sakit = found ? found.sakit : 0;

        // Simpan angka asli untuk tooltip
        // dataCutiReal.push(cuti);
        dataIzinReal.push(izin);
        dataSakitReal.push(sakit);

        // UBAH KE PERSENTASE (dibagi total karyawan, dikali 100)
        // dataCutiPercent.push(totalKaryawan > 0 ? (cuti / totalKaryawan) * 100 : 0);
        dataIzinPercent.push(totalKaryawan > 0 ? (izin / totalKaryawan) * 100 : 0);
        dataSakitPercent.push(totalKaryawan > 0 ? (sakit / totalKaryawan) * 100 : 0);
    }

    const ctx = document.getElementById('kehadiranChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                // {
                //     label: 'Cuti',
                //     data: dataCutiPercent, // Pakai data persentase
                //     backgroundColor: '#F97316', // Orange
                //     borderRadius: 2,
                // },
                {
                    label: 'Izin',
                    data: dataIzinPercent, // Pakai data persentase
                    backgroundColor: '#10B981', // Hijau
                    borderRadius: 2,
                },
                {
                    label: 'Sakit',
                    data: dataSakitPercent, // Pakai data persentase
                    backgroundColor: '#EF4444', // Merah
                    borderRadius: {topLeft: 4, topRight: 4}, // Melengkung hanya di atas
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }, // Kita pakai custom legend di HTML
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let valuePercent = context.raw || 0;
                            // Ambil jumlah orang asli berdasarkan index dan dataset
                            let realDataArrays = [dataCutiReal, dataIzinReal, dataSakitReal];
                            let jumlahOrang = realDataArrays[context.datasetIndex][context.dataIndex];
                            
                            // Tampilan tooltip: "Cuti: 12.5% (1 orang)"
                            return context.dataset.label + ': ' + valuePercent.toFixed(1) + '% (' + jumlahOrang + ' orang)';
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true, 
                    ticks: {
                        font: { size: 11 },
                        maxRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 31
                    },
                    grid: { display: false }
                },
                y: {
                    stacked: true, 
                    beginAtZero: true,
                    max: 100, // MAXIMAL GRAFIK 100%
                    ticks: {
                        stepSize: 10, // LOMPATAN TIAP 10% (0, 10, 20, ... 100)
                        font: { size: 12 },
                        callback: function(value) {
                            return value + '%'; // TAMBAHKAN TANDA %
                        }
                    },
                    grid: { color: '#E5E7EB' },
                    title: {
                        display: true,
                        text: 'Persentase dari Total Karyawan (%)',
                        font: { size: 13, weight: '500' }
                    }
                }
            }
        }
    });
});
</script>

@endsection
