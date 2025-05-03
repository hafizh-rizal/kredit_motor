<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKredit extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_kredit';

    protected $fillable = [
        'id_pelanggan',
        'id_motor',
        'harga_kredit',
        'harga_cash',
        'dp',
        'id_jenis_cicilan',
        'id_asuransi',
        'biaya_asuransi',
        'cicilan_perbulan',
         'tgl_pengajuan_kredit',
        'url_kk',
        'url_ktp',
        'url_npwp',
        'url_slip_gaji',
        'url_foto',
        'status_pengajuan',
        'keterangan_status_pengajuan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motor');
    }

    public function jenisCicilan()
    {
        return $this->belongsTo(JenisCicilan::class, 'id_jenis_cicilan');
    }    

    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class, 'id_asuransi');
    }

    public function kredit()
    {
        return $this->hasMany(Kredit::class, 'id_pengajuan_kredit');
    }
}
