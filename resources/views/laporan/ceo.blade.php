<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan CEO</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { text-align: center; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Laporan CEO Kredit Motor</h1>
    <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>

    <h3>Ringkasan Pengajuan</h3>
    <table>
        <tr>
            <th>Total Pengajuan Kredit</th>
            <td>{{ $totalPengajuan }}</td>
        </tr>
    </table>

    <h3>Motor Terlaris</h3>
    <table>
        <tr>
            <th>Nama Motor</th>
            <td>{{ $motor_terlaris->nama_motor ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jumlah Pengajuan</th>
            <td>{{ $motor_terlaris->pengajuan_kredit_count ?? 0 }}</td>
        </tr>
    </table>
</body>
</html>
