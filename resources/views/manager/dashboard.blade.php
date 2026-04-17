
@extends('manager.template')

@section('title', 'Dashboard Manager')

@section('content')

<!-- FontAwesome & Chart.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root {
    --maroon-primary: #800000;
    --maroon-mid: #5d1010;
    --maroon-light: #fef2f2;
    --maroon-soft: #fee2e2;
}

/* HEADER */
.page-title-section {
    background: linear-gradient(135deg, var(--maroon-light), var(--maroon-soft));
    border-left: 5px solid var(--maroon-primary);
    padding: 18px 22px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.page-title {
    color: var(--maroon-primary);
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 4px;
}

.page-subtitle {
    color: #6b7280;
    font-size: 13px;
    margin: 0;
}

/* SECTION TITLE */
.section-header {
    font-size: 15px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 10px;
    margin-top: 25px;
    padding-bottom: 6px;
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    align-items: center;
}

.section-header i {
    margin-right: 8px;
    color: var(--maroon-primary);
}

/* CARD */
.stat-card {
    border-radius: 14px;
    border: none;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.stat-card .card-body {
    padding: 20px;
}

/* ICON */
.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    background: rgba(255,255,255,0.2);
    color: white;
}

/* TEXT */
.stat-label {
    font-size: 12px;
    font-weight: 500;
    opacity: 0.85;
}

.stat-value {
    font-size: 30px;
    font-weight: 700;
    margin: 4px 0;
}

.stat-sub {
    font-size: 11px;
    opacity: 0.8;
}

/* WARNA CARD (DISAMAKAN) */
.card-total {
    background: linear-gradient(135deg, #800000, #a11212);
    color: white;
}

/* lembur tetap beda tapi masih senada (maroon gelap) */
.card-overtime {
    background: linear-gradient(135deg, #5d1010, #3e2723);
    color: white;
}

/* CHART CARD */
.card-chart {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
}

.card-chart .card-header {
    background: transparent;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 600;
    color: #374151;
}

/* LEGEND */
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
}

/* WARNA LEGEND DISESUAIKAN */
.legend-izin {
    background: #9B1C20; /* maroon */
}

.legend-sakit {
    background: #5d1010; /* dark maroon */
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
                    <canvas id="kehadiranChart"></canvas>
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
