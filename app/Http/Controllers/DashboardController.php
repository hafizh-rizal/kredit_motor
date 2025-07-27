<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JenisMotor;
use App\Models\Pelanggan;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\Kredit;
use App\Models\Angsuran;
use App\Models\Pengiriman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    
    {
        $role = strtolower(Auth::user()->role);

        // Inisialisasi variabel default
        $data = [];

        if ($role === 'admin' || $role === 'ceo') {
            $data = [
                'totalJenisMotor' => JenisMotor::count(),
                'totalPelanggan' => Pelanggan::count(),
                'totalMotor' => Motor::count(),
                'totalPengajuan' => PengajuanKredit::count(),
                'totalKredit' => Kredit::count(),
                'totalAngsuran' => Angsuran::count(),
                'totalPengiriman' => Pengiriman::count(),
                'totalUser' => User::count(),
            ];
        } elseif ($role === 'marketing') {
            $data = [
                'totalPengajuan' => PengajuanKredit::count(),
                'totalKredit' => Kredit::count(),
                'totalAngsuran' => Angsuran::count(),
            ];
        } elseif ($role === 'kurir') {
            $data = [
                'totalPengiriman' => Pengiriman::count(),
            ];
        }
// dd(Auth::user()->role, strtolower(Auth::user()->role));
        // Arahkan ke view berdasarkan role
      if (view()->exists("$role.dashboard")) {
    return view("$role.dashboard", $data);
}


        // Jika role tidak dikenali
        abort(403, 'Unauthorized role');
    }
}
