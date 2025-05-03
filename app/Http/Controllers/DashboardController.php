<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisMotor;
use App\Models\Pelanggan;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\Kredit;
use App\Models\Angsuran;
use App\Models\Pengiriman;

class DashboardController extends Controller
{


    public function index()
    {
        // Hitung total record untuk tiap tabel
        $totalJenisMotor      = JenisMotor::count();
        $totalPelanggan       = Pelanggan::count();
        $totalMotor           = Motor::count();
        $totalPengajuan       = PengajuanKredit::count();
        $totalKredit          = Kredit::count();
        $totalAngsuran        = Angsuran::count();
        $totalPengiriman      = Pengiriman::count();

        return view('dashboard.index', compact(
            'totalJenisMotor',
            'totalPelanggan',
            'totalMotor',
            'totalPengajuan',
            'totalKredit',
            'totalAngsuran',
            'totalPengiriman'
        ));
    }
}
