<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $table = 'motor';

    protected $fillable = [
        'nama_motor', 
        'id_jenis_motor', 
        'harga_jual', 
        'deskripsi_motor', 
        'warna', 
        'kapasitas_mesin', 
        'url_produksi', 
        'foto1', 
        'foto2', 
        'foto3', 
        'stok'
    ];

public function jenis_motor()
{
    return $this->belongsTo(JenisMotor::class, 'id_jenis_motor');
}

    
    public function asuransi()
    {   
        return $this->belongsTo(Asuransi::class);
    }
    
    public function jenis_cicilan()
    {
        return $this->belongsTo(JenisCicilan::class);
    }
    
}
