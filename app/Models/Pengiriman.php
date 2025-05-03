<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $fillable = [
        'invoice', 'tgl_kirim', 'status_kirim', 'nama_kurir', 'telpon_kurir', 'bukti_foto', 'keterangan', 'id_kredit'
    ];

    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'id_kredit');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}