<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kredit Motor</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #2c3e50;
            margin: 30px;
        }
        h1 {
            color: #2980b9;
            text-align: center;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 25px;
        }
        .date {
            text-align: right;
            font-size: 11px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }
        .section-title {
            background-color: #2980b9;
            color: white;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #bdc3c7;
            padding: 8px 6px;
            text-align: left;
        }
        th {
            background-color: #ecf0f1;
            color: #2c3e50;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h1>Laporan Sistem Kredit Motor</h1>
<div class="subtitle">HRide Indonesia</div>

<div class="date">
    {{-- Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }} --}}
    {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
</div>

<div class="section-title">Laporan Pengajuan Kredit</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Motor</th>
            <th>Harga Cash</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengajuan as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->tgl_pengajuan_kredit }}</td>
            <td>{{ $p->pelanggan->nama_pelanggan }}</td>
            <td>{{ $p->motor->nama_motor }}</td>
            <td>Rp {{ number_format($p->harga_cash, 0, ',', '.') }}</td>
            <td>{{ $p->status_pengajuan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="section-title">Laporan Kredit</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Motor</th>
            <th>Tanggal Mulai</th>
            <th>Status Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kredit as $i => $k)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $k->pengajuanKredit->pelanggan->nama_pelanggan }}</td>
            <td>{{ $k->pengajuanKredit->motor->nama_motor }}</td>
            <td>{{ $k->tgl_mulai_kredit }}</td>
            <td>{{ $k->status_kredit }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="section-title">Laporan Angsuran</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Motor</th>
            <th>Angsuran Ke</th>
            <th>Tanggal Bayar</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($angsuran as $i => $a)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $a->kredit->pengajuanKredit->pelanggan->nama_pelanggan }}</td>
            <td>{{ $a->kredit->pengajuanKredit->motor->nama_motor }}</td>
            <td>{{ $a->angsuran_ke }}</td>
            <td>{{ $a->tgl_bayar }}</td>
            <td>Rp {{ number_format($a->total_bayar, 0, ',', '.') }}</td>
            <td>{{ $a->status_pembayaran }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="section-title">Laporan Pengiriman</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Nama Pelanggan</th>
            <th>Motor</th>
            <th>Tanggal Kirim</th>
            <th>Status Kirim</th>
            <th>Kurir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengiriman as $i => $pg)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $pg->invoice }}</td>
            <td>{{ $pg->kredit->pengajuanKredit->pelanggan->nama_pelanggan }}</td>
            <td>{{ $pg->kredit->pengajuanKredit->motor->nama_motor }}</td>
            <td>{{ $pg->tgl_kirim }}</td>
            <td>{{ $pg->status_kirim }}</td>
            <td>{{ $pg->nama_kurir }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
