@extends('admin.template')

@section('content')

<h4 style="margin-bottom:20px;font-weight:600;">Dashboard</h4>

<!-- INFO BOX -->
<div class="row" style="margin-bottom:30px;">
    <div class="col-md-4">
        <div style="
            background:#17c1e8;
            border-radius:16px;
            height:160px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            color:#fff;
            box-shadow:0 6px 16px rgba(0,0,0,.08);
        ">
            <i class="fas fa-file-invoice-dollar" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:28px;font-weight:700;">5</div>
            <div style="font-size:13px;opacity:.9;">Gaji Diproses Hari Ini</div>
        </div>
    </div>

    <div class="col-md-4">
        <div style="
            background:#fbc02d;
            border-radius:16px;
            height:160px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            color:#000;
            box-shadow:0 6px 16px rgba(0,0,0,.08);
        ">
            <i class="fas fa-users" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:28px;font-weight:700;">12</div>
            <div style="font-size:13px;">Karyawan Digaji Terakhir</div>
        </div>
    </div>

    <div class="col-md-4">
        <div style="
            background:#e53935;
            border-radius:16px;
            height:160px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            color:#fff;
            box-shadow:0 6px 16px rgba(0,0,0,.08);
        ">
            <i class="fas fa-wallet" style="font-size:26px;margin-bottom:8px;"></i>
            <div style="font-size:26px;font-weight:700;">Rp 120jt</div>
            <div style="font-size:13px;opacity:.9;">Total Gaji Bulan Ini</div>
        </div>
    </div>
</div>

<!-- GRAFIK + LIST -->
<div class="row">

    <!-- GRAFIK -->
    <div class="col-md-7">
        <div style="
            background:#fff;
            border-radius:16px;
            box-shadow:0 6px 16px rgba(0,0,0,.06);
            padding:20px;
        ">
            <div style="font-weight:600;margin-bottom:10px;color:#1565c0;">
                Grafik Komposisi Gaji
            </div>

            <div style="display:flex;justify-content:center;">
                <canvas id="gajiChart" width="220" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- LIST -->
    <div class="col-md-5">
        <div style="
            background:#fff;
            border-radius:16px;
            box-shadow:0 6px 16px rgba(0,0,0,.06);
            padding:20px;
        ">
            <div style="font-weight:600;margin-bottom:10px;color:#f9a825;">
                Status Gaji Karyawan
            </div>

            <ul style="list-style:none;padding:0;margin:0;">
                <li style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee;">
                    Andi Pratama
                    <span style="background:#2e7d32;color:#fff;padding:4px 12px;border-radius:12px;font-size:12px;">
                        Dibayar
                    </span>
                </li>
                <li style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee;">
                    Siti Aisyah
                    <span style="background:#f9a825;color:#000;padding:4px 12px;border-radius:12px;font-size:12px;">
                        Proses
                    </span>
                </li>
                <li style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee;">
                    Budi Santoso
                    <span style="background:#d32f2f;color:#fff;padding:4px 12px;border-radius:12px;font-size:12px;">
                        Belum
                    </span>
                </li>
                <li style="display:flex;justify-content:space-between;padding:10px 0;">
                    Dewi Lestari
                    <span style="background:#2e7d32;color:#fff;padding:4px 12px;border-radius:12px;font-size:12px;">
                        Dibayar
                    </span>
                </li>
            </ul>
        </div>
    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('gajiChart'), {
    type: 'pie',
    data: {
        labels: ['Gaji Pokok', 'Tunjangan', 'Potongan'],
        datasets: [{
            data: [70, 20, 10]
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                position: 'right', // 🔥 PINDAH KE SAMPING
                labels: {
                    boxWidth: 10,
                    font: { size: 10 },
                    padding: 12
                }
            }
        }
    }
});
</script>

@endsection
