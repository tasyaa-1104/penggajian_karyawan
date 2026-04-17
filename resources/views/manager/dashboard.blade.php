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

.card-total {
    background: linear-gradient(135deg, #800000, #a11212);
    color: white;
}

.card-overtime {
    background: linear-gradient(135deg, #5d1010, #3e2723);
    color: white;
}

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

#kehadiranChart {
    cursor: pointer;
}

/* ============================================ */
/* MODAL                                        */
/* ============================================ */
.modal-detail .modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
}

.modal-detail .modal-header {
    background: linear-gradient(135deg, #800000, #a11212);
    color: white;
    padding: 16px 20px;
    border: none;
}

.modal-detail .modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modal-detail .modal-header .btn-close:hover {
    opacity: 1;
}

.modal-detail .modal-body {
    padding: 0;
    max-height: 65vh;
    overflow-y: auto;
}

.modal-detail .modal-footer {
    border-top: 1px solid #e5e7eb;
    padding: 12px 20px;
}

.modal-group-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px 8px;
    font-size: 13px;
    font-weight: 700;
    color: #374151;
}

.modal-group-header:first-child {
    padding-top: 18px;
}

.modal-group-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.modal-group-count {
    margin-left: auto;
    background: #f3f4f6;
    color: #6b7280;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.modal-group-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 8px 20px;
}

.employee-list-item {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    border-bottom: 1px solid #f9fafb;
    transition: background 0.15s ease;
}

.employee-list-item:hover {
    background: #f9fafb;
}

.employee-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    margin-right: 14px;
    flex-shrink: 0;
}

.avatar-izin {
    background: #d1fae5;
    color: #065f46;
}

.avatar-sakit {
    background: #fee2e2;
    color: #991b1b;
}

.employee-name {
    font-weight: 600;
    font-size: 14px;
    color: #1f2937;
}

.employee-keterangan {
    font-size: 11px;
    color: #9ca3af;
    margin-top: 3px;
    font-style: italic;
}

.employee-badge {
    margin-left: auto;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    flex-shrink: 0;
}

.badge-izin-sm {
    background: #d1fae5;
    color: #065f46;
}

.badge-sakit-sm {
    background: #fee2e2;
    color: #991b1b;
}

/* Empty & loading */
.state-container {
    text-align: center;
    padding: 40px 20px;
    color: #9ca3af;
}

.state-container i {
    font-size: 42px;
    margin-bottom: 12px;
    display: block;
}

.state-container p {
    font-size: 13px;
    margin: 0;
}

.spinner-inline {
    display: inline-block;
    width: 22px;
    height: 22px;
    border: 3px solid rgba(128,0,0,0.15);
    border-top-color: var(--maroon-primary);
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* ============================================ */
/* FILTER & REKAP BULANAN                       */
/* ============================================ */
.filter-section {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 16px;
}

.filter-section label {
    font-weight: 600;
    font-size: 13px;
    color: #374151;
    margin-bottom: 5px;
    display: block;
}

.filter-section .form-select {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    color: #374151;
    background-color: white;
    transition: border-color 0.2s;
}

.filter-section .form-select:focus {
    border-color: var(--maroon-primary);
    box-shadow: 0 0 0 3px rgba(128,0,0,0.1);
}

.btn-filter-rekap {
    background: linear-gradient(135deg, #800000, #a11212);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 9px 20px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
    width: 100%;
}

.btn-filter-rekap:hover {
    background: linear-gradient(135deg, #5d1010, #800000);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(128,0,0,0.3);
}

.btn-filter-rekap:active {
    transform: translateY(0);
}

.rekap-table {
    font-size: 13px;
    margin-bottom: 0;
}

.rekap-table thead th {
    background: linear-gradient(135deg, #800000, #a11212);
    color: white;
    font-weight: 600;
    padding: 12px 14px;
    border: none;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    white-space: nowrap;
}

.rekap-table tbody td {
    padding: 11px 14px;
    border-color: #f3f4f6;
    vertical-align: middle;
    color: #374151;
}

.rekap-table tbody tr {
    transition: background 0.15s ease;
}

.rekap-table tbody tr:hover {
    background: var(--maroon-light);
}

.rekap-table tbody tr:last-child td {
    border-bottom: none;
}

.badge-rekap-izin {
    background: #d1fae5;
    color: #065f46;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    min-width: 60px;
    text-align: center;
}

.badge-rekap-sakit {
    background: #fee2e2;
    color: #991b1b;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    min-width: 60px;
    text-align: center;
}

.badge-rekap-total {
    background: #f3f4f6;
    color: #374151;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
    min-width: 60px;
    text-align: center;
}

.rekap-summary {
    display: flex;
    gap: 24px;
    padding: 14px 20px;
    background: #f9fafb;
    border-top: 2px solid #e5e7eb;
    flex-wrap: wrap;
}

.rekap-summary-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.rekap-summary-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.rekap-summary-label {
    font-size: 12px;
    color: #6b7280;
}

.rekap-summary-value {
    font-size: 14px;
    font-weight: 700;
    color: #1f2937;
}

.chart-hint {
    text-align: center;
    font-size: 12px;
    color: #9ca3af;
    margin-top: 8px;
}

.chart-hint i {
    margin-right: 4px;
    color: var(--maroon-primary);
    opacity: 0.5;
}

@media (max-width: 768px) {
    .stat-value { font-size: 24px; }
    .custom-legend { gap: 12px; font-size: 12px; }
    .rekap-table { font-size: 12px; }
    .rekap-summary { gap: 16px; }
    .employee-badge { display: none; }
}
</style>

<!-- MODAL -->
<div class="modal fade modal-detail" id="modalDetailKaryawan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h6 class="modal-title mb-0" style="font-size:15px;">
                        <i class="fas fa-list-ul me-2"></i>
                        <span id="modalTitle">Detail Karyawan</span>
                    </h6>
                    <small id="modalSubtitle" style="opacity:0.8;font-size:12px;"></small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalBodyContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-bs-dismiss="modal" style="background:#f3f4f6;color:#374151;border-radius:8px;font-weight:600;font-size:13px;">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">

    <div class="page-title-section">
        <h3 class="page-title">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Manager
        </h3>
        <p class="page-subtitle">Ringkasan data karyawan dan kehadiran harian</p>
    </div>

    {{-- ROW 1 --}}
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
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
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
                        <div class="stat-icon"><i class="fas fa-business-time"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="section-header mt-4">
        <i class="fas fa-chart-bar"></i> Detail Kehadiran Bulan Ini
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="card stat-card card-chart">
                <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>Jumlah Karyawan per Status Harian</span>
                    <div class="custom-legend">
                        <span><span class="legend-dot" style="background-color: #10B981;"></span> Izin</span>
                        <span><span class="legend-dot" style="background-color: #EF4444;"></span> Sakit</span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="position:relative;height:320px;">
                        <canvas id="kehadiranChart"></canvas>
                    </div>
                    <p class="chart-hint">
                        <i class="fas fa-mouse-pointer"></i> Klik pada bar untuk melihat karyawan izin & sakit
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- REKAP BULANAN (PAKAI PHP BIASA, BUKAN JAVASCRIPT) --}}
    <div class="section-header mt-4">
        <i class="fas fa-calendar-alt"></i> Rekap Kehadiran Bulanan
    </div>

    <form action="{{ route('manager.dashboard') }}" method="GET" class="filter-section">
        <div class="row g-3 align-items-end">
            <div class="col-md-4 col-sm-6">
                <label><i class="fas fa-calendar-day me-1" style="color:var(--maroon-primary);"></i> Bulan</label>
                <select name="bulan" class="form-select">
                    @php $monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; @endphp
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ (isset($filterBulan) && $filterBulan == $i) ? 'selected' : '' }}>{{ $monthNames[$i-1] }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 col-sm-6">
                <label><i class="fas fa-calendar me-1" style="color:var(--maroon-primary);"></i> Tahun</label>
                <select name="tahun" class="form-select">
                    @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ (isset($filterTahun) && $filterTahun == $y) ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 col-sm-12">
                <button type="submit" class="btn-filter-rekap"><i class="fas fa-filter me-1"></i> Tampilkan Rekap</button>
            </div>
        </div>
    </form>

    <div class="card stat-card card-chart">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table rekap-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama Karyawan</th>
                            <th class="text-center">% Izin</th>
                            <th class="text-center">% Sakit</th>
                            <th class="text-center">% Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($rekapBulanan) && $rekapBulanan->count() > 0)
                            @foreach($rekapBulanan as $index => $r)
                                @php
                                    $warnaIzin  = 'background:#d1fae5;color:#065f46;';
                                    $warnaSakit = 'background:#fee2e2;color:#991b1b;';
                                    $warnaTotal = 'background:#f3f4f6;color:#374151;';
                                    if($r['persen_izin'] > 10) $warnaIzin = 'background:#fde68a;color:#92400e;';
                                    if($r['persen_sakit'] > 10) $warnaSakit = 'background:#fde68a;color:#92400e;';
                                    if($r['persen_total'] > 20) $warnaTotal = 'background:#fee2e2;color:#991b1b;';
                                @endphp
                                <tr>
                                    <td style="color:#9ca3af;">{{ $index + 1 }}</td>
                                    <td><strong style="color:#1f2937;">{{ $r['nama'] }}</strong></td>
                                    <td class="text-center"><span class="badge-rekap-izin" style="{{ $warnaIzin }}">{{ $r['persen_izin'] }}%</span></td>
                                    <td class="text-center"><span class="badge-rekap-sakit" style="{{ $warnaSakit }}">{{ $r['persen_sakit'] }}%</span></td>
                                    <td class="text-center"><span class="badge-rekap-total" style="{{ $warnaTotal }}">{{ $r['persen_total'] }}%</span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <div class="state-container">
                                        <i class="fas fa-folder-open" style="color:#d1d5db;"></i>
                                        <p style="color:#6b7280;">Tidak ada data izin/sakit di bulan ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="px-3 py-2" style="background:#f9fafb;border-top:1px solid #e5e7eb;">
                <p style="margin:0;font-size:11px;color:#9ca3af;">
                    <i class="fas fa-calculator me-1"></i>
                    Rumus: (Jumlah Hari / <span style="font-weight:600;color:#6b7280;">{{ $jumlahHari ?? now()->daysInMonth }}</span> Hari) × 100
                    &nbsp;|&nbsp;
                    <span style="display:inline-block;width:10px;height:10px;background:#fde68a;border-radius:2px;vertical-align:middle;"></span> >10% &nbsp;
                    <span style="display:inline-block;width:10px;height:10px;background:#fee2e2;border-radius:2px;vertical-align:middle;"></span> Total >20%
                </p>
            </div>

            @if(isset($rekapBulanan) && $rekapBulanan->count() > 0)
            <div class="rekap-summary" style="display:flex;">
                <div class="rekap-summary-item">
                    <span class="rekap-summary-dot" style="background:#10B981;"></span>
                    <span class="rekap-summary-label">Rata-rata Izin:</span>
                    <span class="rekap-summary-value">{{ $avgIzin ?? 0 }}%</span>
                </div>
                <div class="rekap-summary-item">
                    <span class="rekap-summary-dot" style="background:#EF4444;"></span>
                    <span class="rekap-summary-label">Rata-rata Sakit:</span>
                    <span class="rekap-summary-value">{{ $avgSakit ?? 0 }}%</span>
                </div>
                <div class="rekap-summary-item">
                    <span class="rekap-summary-dot" style="background:#6b7280;"></span>
                    <span class="rekap-summary-label">Rata-rata Total:</span>
                    <span class="rekap-summary-value">{{ $avgTotal ?? 0 }}%</span>
                </div>
                <div class="rekap-summary-item ms-auto">
                    <span class="rekap-summary-label">Karyawan:</span>
                    <span class="rekap-summary-value">{{ $rekapBulanan->count() }}</span>
                    <span class="rekap-summary-label">orang</span>
                </div>
            </div>
            @endif
        </div>
    </div>

</div> <!-- PENUTUK CONTAINER-FLUID -->

<script>
document.addEventListener("DOMContentLoaded", function() {

    const totalKaryawan = {{ $jumlah_karyawan }};
    const rawData = @json($chartAbsensi);

    const labels = [];
    const labelsRaw = [];
    const dataIzinPercent = [];
    const dataSakitPercent = [];
    const dataIzinReal = [];
    const dataSakitReal = [];

    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    const now = new Date();
    const year = now.getFullYear();
    const monthIndex = now.getMonth();
    const todayDate = now.getDate();

    for (let d = 1; d <= todayDate; d++) {
        let dateStr = year + '-' + String(monthIndex + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
        labels.push(d + ' ' + months[monthIndex]);
        labelsRaw.push(dateStr);

        let found = rawData.find(function(item) { return item.tanggal === dateStr; });

        let izin  = found ? found.izin  : 0;
        let sakit = found ? found.sakit : 0;

        dataIzinReal.push(izin);
        dataSakitReal.push(sakit);
        dataIzinPercent.push(totalKaryawan > 0 ? (izin / totalKaryawan) * 100 : 0);
        dataSakitPercent.push(totalKaryawan > 0 ? (sakit / totalKaryawan) * 100 : 0);
    }

    const ctx = document.getElementById('kehadiranChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Izin',
                    data: dataIzinPercent,
                    backgroundColor: '#10B981',
                    borderRadius: 2,
                    hoverBackgroundColor: '#059669',
                },
                {
                    label: 'Sakit',
                    data: dataSakitPercent,
                    backgroundColor: '#EF4444',
                    borderRadius: { topLeft: 4, topRight: 4 },
                    hoverBackgroundColor: '#DC2626',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        title: function(items) {
                            return 'Tanggal: ' + items[0].label;
                        },
                        label: function(context) {
                            var valuePercent = context.raw || 0;
                            var realArrays = [dataIzinReal, dataSakitReal];
                            var jumlah = realArrays[context.datasetIndex][context.dataIndex];
                            return context.dataset.label + ': ' + valuePercent.toFixed(1) + '% (' + jumlah + ' orang)';
                        },
                        afterBody: function() {
                            return ['\nKlik untuk lihat detail karyawan'];
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    ticks: { font: { size: 11 }, maxRotation: 0, autoSkip: true, maxTicksLimit: 31 },
                    grid: { display: false }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 10,
                        font: { size: 12 },
                        callback: function(v) { return v + '%'; }
                    },
                    grid: { color: '#E5E7EB' },
                    title: {
                        display: true,
                        text: 'Persentase dari Total Karyawan (%)',
                        font: { size: 13, weight: '500' }
                    }
                }
            },
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    var dataIndex = elements[0].index;
                    var tanggal = labelsRaw[dataIndex];

                    var jumlahIzin  = dataIzinReal[dataIndex];
                    var jumlahSakit = dataSakitReal[dataIndex];
                    var jumlahTotal = jumlahIzin + jumlahSakit;

                    if (jumlahTotal === 0) {
                        showModalEmpty(tanggal);
                    } else {
                        showModalLoading(tanggal, jumlahIzin, jumlahSakit);
                        fetchDetailKaryawan(tanggal);
                    }
                }
            }
        }
    });


    /* ============================================ */
    /* MODAL                                        */
    /* ============================================ */
    var modalInstance = null;

    function getModal() {
        if (!modalInstance) {
            modalInstance = new bootstrap.Modal(document.getElementById('modalDetailKaryawan'));
        }
        return modalInstance;
    }

    function formatTanggalIndo(dateStr) {
        var d = new Date(dateStr + 'T00:00:00');
        return d.toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    function showModalLoading(tanggal, jIzin, jSakit) {
        document.getElementById('modalTitle').innerHTML = 'Karyawan Izin & Sakit';
        document.getElementById('modalSubtitle').textContent = formatTanggalIndo(tanggal);

        document.getElementById('modalBodyContent').innerHTML =
            '<div class="state-container">' +
                '<div class="spinner-inline" style="width:28px;height:28px;border-width:4px;"></div>' +
                '<p class="mt-3">Memuat ' + (jIzin + jSakit) + ' karyawan...</p>' +
            '</div>';

        getModal().show();
    }

    function showModalEmpty(tanggal) {
        document.getElementById('modalTitle').textContent = 'Karyawan Izin & Sakit';
        document.getElementById('modalSubtitle').textContent = formatTanggalIndo(tanggal);

        document.getElementById('modalBodyContent').innerHTML =
            '<div class="state-container">' +
                '<i class="fas fa-inbox" style="color:#d1d5db;"></i>' +
                '<p style="color:#6b7280;">Tidak ada karyawan izin maupun sakit pada tanggal ini</p>' +
            '</div>';

        getModal().show();
    }

    function showModalError(pesan) {
        document.getElementById('modalBodyContent').innerHTML =
            '<div class="state-container">' +
                '<i class="fas fa-exclamation-triangle" style="color:#EF4444;"></i>' +
                '<p style="color:#EF4444;font-weight:600;margin-bottom:8px;">Error</p>' +
                '<p style="color:#6b7280;font-size:12px;word-break:break-all;">' + (pesan || 'Gagal memuat data') + '</p>' +
            '</div>';
        getModal().show();
    }

    function showModalSuccess(dataIzin, dataSakit) {
        var body = document.getElementById('modalBodyContent');
        var html = '';
        var adaIzin  = dataIzin && dataIzin.length > 0;
        var adaSakit = dataSakit && dataSakit.length > 0;

        if (adaIzin) {
            html += '<div class="modal-group-header">';
            html += '  <span class="modal-group-dot" style="background:#10B981;"></span>';
            html += '  Izin';
            html += '  <span class="modal-group-count">' + dataIzin.length + ' orang</span>';
            html += '</div>';

            for (var i = 0; i < dataIzin.length; i++) {
                var k = dataIzin[i];
                html += '<div class="employee-list-item">';
                html += '  <div class="employee-avatar avatar-izin">' + k.nama.charAt(0).toUpperCase() + '</div>';
                html += '  <div style="flex:1;min-width:0;">';
                html += '    <div class="employee-name">' + k.nama + '</div>';
                if (k.keterangan && k.keterangan !== '-') {
                    html += '    <div class="employee-keterangan"><i class="fas fa-comment-dots me-1"></i>' + k.keterangan + '</div>';
                }
                html += '  </div>';
                html += '  <span class="employee-badge badge-izin-sm">Izin</span>';
                html += '</div>';
            }
        }

        if (adaIzin && adaSakit) {
            html += '<div class="modal-group-divider"></div>';
        }

        if (adaSakit) {
            html += '<div class="modal-group-header">';
            html += '  <span class="modal-group-dot" style="background:#EF4444;"></span>';
            html += '  Sakit';
            html += '  <span class="modal-group-count">' + dataSakit.length + ' orang</span>';
            html += '</div>';

            for (var j = 0; j < dataSakit.length; j++) {
                var s = dataSakit[j];
                html += '<div class="employee-list-item">';
                html += '  <div class="employee-avatar avatar-sakit">' + s.nama.charAt(0).toUpperCase() + '</div>';
                html += '  <div style="flex:1;min-width:0;">';
                html += '    <div class="employee-name">' + s.nama + '</div>';
                if (s.keterangan && s.keterangan !== '-') {
                    html += '    <div class="employee-keterangan"><i class="fas fa-comment-dots me-1"></i>' + s.keterangan + '</div>';
                }
                html += '  </div>';
                html += '  <span class="employee-badge badge-sakit-sm">Sakit</span>';
                html += '</div>';
            }
        }

        body.innerHTML = html;
    }


    /* ============================================ */
    /* FETCH: ambil IZIN + SAKIT sekaligus         */
    /* ============================================ */
    function fetchDetailKaryawan(tanggal) {
        fetch('{{ route("manager.dashboard.detail-kehadiran") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ tanggal: tanggal })
        })
        .then(function(response) {
            if (!response.ok) throw new Error('HTTP ' + response.status);
            return response.json();
        })
        .then(function(data) {
            if (data.success === false) {
                showModalError(data.message || 'Terjadi kesalahan');
                return;
            }
            var adaData = (data.izin && data.izin.length > 0) || (data.sakit && data.sakit.length > 0);
            if (adaData) {
                showModalSuccess(data.izin || [], data.sakit || []);
            } else {
                showModalEmpty(tanggal);
            }
        })
        .catch(function(err) {
            console.error('Fetch detail error:', err);
            showModalError('Gagal menghubungi server. Cek console (F12).');
        });
    }

}); // PENUTUP SCRIPT
</script>

@endsection
