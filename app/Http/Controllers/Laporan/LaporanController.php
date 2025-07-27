<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanKredit;
use App\Models\Kredit;
use App\Models\Angsuran;
use App\Models\Pengiriman;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function downloadPdf()
    {
        $pengajuan = PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan', 'asuransi'])->get();
        $kredit = Kredit::with(['pengajuanKredit', 'metodeBayar'])->get();
        $angsuran = Angsuran::with('kredit')->get();
        $pengiriman = Pengiriman::with('kredit')->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('pengajuan', 'kredit', 'angsuran', 'pengiriman'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('laporan_kredit_motor.pdf');
    }
}
