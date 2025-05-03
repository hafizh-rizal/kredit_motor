<?php
use Illuminate\Support\Facades\Route;
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
    ProductController
};

Route::prefix('pelanggan')->middleware('guest:pelanggan')->group(function () {
    Route::get('/login', [PelangganAuthController::class, 'loginForm'])->name('pelanggan.auth.login');
    Route::post('/login', [PelangganAuthController::class, 'login'])->name('pelanggan.auth.login');  
    Route::get('/register', [PelangganAuthController::class, 'registerForm'])->name('pelanggan.auth.register');
    Route::post('/register', [PelangganAuthController::class, 'register'])->name('pelanggan.auth.register.submit');
    
});

Route::post('/pelanggan/logout', [PelangganAuthController::class, 'logout'])->name('pelanggan.auth.logout');


Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest')->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::get('/ceo', [CeoController::class, 'index'])->name('ceo.index');

Route::middleware('auth')->group(function () {
Route::get('/pengajuan_kredit/saya', [PengajuanKreditController::class, 'myPengajuan'])->name('pengajuan_kredit.saya')->middleware('auth:pelanggan');
Route::get('/pengajuan_kredit/saya/{pengajuan_kredit}', [PengajuanKreditController::class, 'show'])->name('pengajuan_kredit.show');
Route::get('/kredit/saya', [KreditController::class, 'myKredit'])->name('kredit.saya')->middleware('auth:pelanggan');
Route::get('pengiriman/saya', [PengirimanController::class, 'myPengiriman'])->name('pengiriman.saya')->middleware('auth:pelanggan');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('motor', MotorController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('asuransi', AsuransiController::class);
    Route::resource('jenis_motor', JenisMotorController::class);
    Route::resource('jenis_cicilan', JenisCicilanController::class);
    Route::resource('metode_bayar', MetodeBayarController::class);
    Route::resource('pengajuan_kredit', PengajuanKreditController::class);
    Route::resource('kredit', KreditController::class);
    Route::resource('angsuran', AngsuranController::class);
    Route::resource('pengiriman', PengirimanController::class);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('/motor/{id}/detail', [MotorController::class, 'detail'])->name('motor.detail');

