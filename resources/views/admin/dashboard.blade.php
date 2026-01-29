@extends('admin.template')

@section('content')

<h4 style="margin-bottom:20px;font-weight:600;">Dashboard</h4>

<!-- INFO BOX -->
<div class="row" style="margin-bottom:30px;">

    <!-- Total Karyawan -->
    <div class="col-md-4">
        <div style="background:#17c1e8;border-radius:16px;height:160px;
            display:flex;flex-direction:column;align-items:center;
            justify-content:center;color:#fff;">
            <i class="fas fa-users" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:28px;font-weight:700;">
                {{ $jumlah_karyawan }}
            </div>
            <div style="font-size:13px;">Total Karyawan</div>
        </div>
    </div>

    <!-- Total Data Gaji -->
    <div class="col-md-4">
        <div style="background:#fbc02d;border-radius:16px;height:160px;
            display:flex;flex-direction:column;align-items:center;
            justify-content:center;color:#000;">
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
            justify-content:center;color:#fff;">
            <i class="fas fa-wallet" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:26px;font-weight:700;">
                Rp {{ number_format($total_gaji_bulan,0,',','.') }}
            </div>
            <div style="font-size:13px;">Total Gaji Bulanan</div>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="row">

    <!-- Grafik Komposisi Gaji -->
    <div class="col-md-6">
        <div style="background:#fff;border-radius:16px;padding:20px;">
            <div style="font-weight:600;margin-bottom:10px;color:#1565c0;">
                Grafik Komposisi Gaji
            </div>

            <div style="display:flex;justify-content:center;">
                <canvas id="grafikKomposisiGaji" width="220" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Gaji Karyawan -->
    <div class="col-md-6">
        <div style="background:#fff;border-radius:16px;padding:20px;">
            <div style="font-weight:600;margin-bottom:10px;color:#f9a825;">
                Status Gaji Karyawan
            </div>

            @foreach($status_karyawan as $row)
                <div style="display:flex;justify-content:space-between;
                    align-items:center;padding:8px 0;border-bottom:1px solid #eee;">

                    <span>{{ $row['nama'] }}</span>

                    @if($row['status'] == 'Dibayar')
                        <span class="badge bg-success">Dibayar</span>
                    @else
                        <span class="badge bg-danger">Belum</span>
                    @endif

                </div>
            @endforeach

        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const komposisi = @json($komposisi_gaji);

// Grafik Komposisi Gaji
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
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
});

</script>

@endsection
