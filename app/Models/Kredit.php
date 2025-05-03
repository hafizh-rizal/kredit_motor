<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    use HasFactory;

    protected $table = 'kredit'; 

    protected $fillable = [
        'id_pengajuan_kredit', 
        'id_metode_bayar', 
        'tgl_mulai_kredit', 
        'tgl_selesai_kredit', 
        'sisa_kredit', 
        'status_kredit', 
        'keterangan_status_kredit',
    ];

    public function metodeBayar()
    {
        return $this->belongsTo(MetodeBayar::class, 'id_metode_bayar');
    }
public function pengajuanKredit()
{
    return $this->belongsTo(PengajuanKredit::class, 'id_pengajuan_kredit');
}

public function motor()
{
    return $this->belongsTo(Motor::class, 'id_motor');
}

public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
}

public function pengiriman()
{
    return $this->hasMany(Pengiriman::class, 'id_kredit');
}
}