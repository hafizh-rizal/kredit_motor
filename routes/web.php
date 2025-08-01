<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AdminController,
    MarketingController,
    CeoController,
    AuthController,
    DashboardController,
    PelangganAuthController,
    MotorController,
    PelangganController,
    AsuransiController,
    JenisMotorController,
    JenisCicilanController,
    MetodeBayarController,
    PengajuanKreditController,
    KreditController,
    AngsuranController,
    PengirimanController,
    HomeController,
    AboutController,
    ContactController,
    KurirController,
    ProductController,
    ServiceController,
    UserController

};

Route::prefix('pelanggan')->middleware('guest:pelanggan')->group(function () {
    Route::get('/login', [PelangganAuthController::class, 'loginForm'])->name('pelanggan.auth.login');
    Route::post('/login', [PelangganAuthController::class, 'login'])->name('pelanggan.auth.submit');
    Route::get('/register', [PelangganAuthController::class, 'registerForm'])->name('pelanggan.auth.register');
    Route::post('/register', [PelangganAuthController::class, 'register'])->name('pelanggan.auth.register.submit');
});


Route::post('/pelanggan/logout', [PelangganAuthController::class, 'logout'])->name('pelanggan.auth.logout');

Route::middleware('auth:pelanggan')->group(function () {
    Route::get('/pengajuan_kredit/saya', [PengajuanKreditController::class, 'myPengajuan'])->name('pengajuan_kredit.saya');
    Route::get('/pengajuan_kredit/saya/{pengajuan_kredit}', [PengajuanKreditController::class, 'show'])->name('pelanggan.pengajuan_kredit.show');
    Route::get('/kredit/saya', [KreditController::class, 'myKredit'])->name('kredit.saya');
    Route::get('/pengiriman/saya', [PengirimanController::class, 'myPengiriman'])->name('pengiriman.saya');
    Route::get('/pengiriman/saya/{pengiriman}', [PengirimanController::class, 'show'])->name('pelanggan.pengiriman.show');
    Route::get('/kredit/saya/{id}', [KreditController::class, 'show'])->name('pelanggan.kredit.show');


    Route::get('/pengajuan_kredit/create', [PengajuanKreditController::class, 'create'])->name('pengajuan_kredit.create');
    Route::post('/pengajuan_kredit', [PengajuanKreditController::class, 'store'])->name('pengajuan_kredit.store');

    
    Route::get('/kredit/create', [KreditController::class, 'create'])->name('kredit.create');
    Route::post('/kredit', [KreditController::class, 'store'])->name('kredit.store');

    Route::get('/angsuran/create', [AngsuranController::class, 'create'])->name('angsuran.create');
    Route::post('/angsuran', [AngsuranController::class, 'store'])->name('angsuran.store');
});

Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest')->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
Route::resource('users', UserController::class);
    //  Route::get('/dashboard', function () {
    //     $role = Auth::user()->role;

    //     if ($role === 'admin') {
    //         return view('admin.dashboard');
    //     } elseif ($role === 'marketing') {
    //         return view('marketing.dashboard');
    //     } elseif ($role === 'kurir') {
    //         return view('kurir.dashboard');
    //     } elseif ($role === 'ceo') {
    //         return view('ceo.dashboard');
    //     } else {
    //         abort(403); 
    //     }
    // })->name('dashboard');
    //   Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    // Route::get('/ceo', [CeoController::class, 'index'])->name('ceo.index');
    // Route::get('/kurir', [KurirController::class, 'index'])->name('kurir.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kredit', KreditController::class)->except(['create', 'store']);
    Route::resource('angsuran', AngsuranController::class)->except(['create', 'store']);
    Route::resource('pengajuan_kredit', PengajuanKreditController::class)->except(['create', 'store']);


    Route::resources([
        'motor' => MotorController::class,
        'pelanggan' => PelangganController::class,
        'asuransi' => AsuransiController::class,
        'jenis_motor' => JenisMotorController::class,
        'jenis_cicilan' => JenisCicilanController::class,
        // 'kredit' => KreditController::class,
        'metode_bayar' => MetodeBayarController::class,
        'pengiriman' => PengirimanController::class
    ]);
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('/motor/{id}/detail', [MotorController::class, 'detail'])->name('motor.detail');

// use App\Http\Controllers\LaporanCEOController;

// Route::get('/laporan-ceo-pdf', [LaporanCEOController::class, 'exportPdf']);
use App\Http\Controllers\Laporan\LaporanController;

Route::get('/laporan/download', [LaporanController::class, 'downloadPdf'])->name('laporan.download');

use Illuminate\Notifications\DatabaseNotification;

Route::delete('/notifikasi/{id}', function ($id) {
    $user = Auth::guard('pelanggan')->user();

    $notification = DatabaseNotification::where('id', $id)
        ->where('notifiable_id', $user->id)
        ->where('notifiable_type', get_class($user))
        ->first();

    if (!$notification) {
        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
    }

    if (is_null($notification->read_at)) {
        $notification->markAsRead();
    }

    $notification->delete();

    return response()->json(['success' => true]);
})->middleware('auth:pelanggan');
