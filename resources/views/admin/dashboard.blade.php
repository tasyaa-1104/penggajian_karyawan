@extends('admin.template')

@section('content')

<h4 style="margin-bottom:20px;font-weight:600;">Dashboard</h4>

<!-- INFO BOX -->
<div class="row" style="margin-bottom:30px;">

    <!-- Total Karyawan -->
    <div class="col-md-4">
        <div style="background:#17c1e8;border-radius:16px;height:160px;
            display:flex;flex-direction:column;align-items:center;
            justify-content:center;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,.08);">
            <i class="fas fa-users" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:28px;font-weight:700;">
                {{ $jumlah_karyawan }}
            </div>
            <div style="font-size:13px;opacity:.9;">Total Karyawan</div>
        </div>
    </div>

    <!-- Total Data Gaji -->
    <div class="col-md-4">
        <div style="background:#fbc02d;border-radius:16px;height:160px;
            display:flex;flex-direction:column;align-items:center;
            justify-content:center;color:#000;box-shadow:0 6px 16px rgba(0,0,0,.08);">
            <i class="fas fa-file-invoice-dollar" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:28px;font-weight:700;">
                {{ $jumlah_gaji }}
            </div>
            <div style="font-size:13px;">Total Data Gaji</div>
        </div>
    </div>

    <!-- Total Gaji Bulanan -->
    <div class="col-md-4">
        <div style="background:#e53935;border-radius:16px;height:160px;
            display:flex;flex-direction:column;align-items:center;
            justify-content:center;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,.08);">
            <i class="fas fa-wallet" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:26px;font-weight:700;">
                Rp {{ number_format($total_gaji_bulan,0,',','.') }}
            </div>
            <div style="font-size:13px;opacity:.9;">Total Gaji Bulanan</div>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="row mt-4">

    <!-- Grafik Komposisi Gaji (DIPERKECIL) -->
    <div class="col-md-6">
        <div style="background:#fff;border-radius:16px;
            box-shadow:0 6px 16px rgba(0,0,0,.06);padding:20px;">
            <div style="font-weight:600;margin-bottom:10px;color:#1565c0;">
                Grafik Komposisi Gaji
            </div>

            <div style="display:flex;justify-content:center;">
                <canvas id="grafikKomposisiGaji" width="220" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Status Gaji -->
    <div class="col-md-6">
        <div style="background:#fff;border-radius:16px;
            box-shadow:0 6px 16px rgba(0,0,0,.06);padding:20px;">
            <div style="font-weight:600;margin-bottom:10px;color:#f9a825;">
                Status Gaji Karyawan
            </div>

            <div style="display:flex;justify-content:center;">
                <canvas id="grafikStatusGaji" width="220" height="220"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const grafikStatus = @json($status_gaji ?? []);
const komposisi = @json($komposisi_gaji ?? [50,30,20]);

// Grafik Komposisi Gaji (Kecil)
new Chart(document.getElementById('grafikKomposisiGaji'), {
    type: 'pie',
    data: {
        labels: ['Gaji Pokok','Tunjangan','Potongan'],
        datasets: [{
            data: komposisi
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 12,
                    font: { size: 11 }
                }
            }
        }
    }
});

// Grafik Status Gaji
new Chart(document.getElementById('grafikStatusGaji'), {
    type: 'pie',
    data: {
        labels: grafikStatus.map(item => item.status),
        datasets: [{
            data: grafikStatus.map(item => item.total)
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 12,
                    font: { size: 11 }
                }
            }
        }
    }
});
</script>

@endsection
