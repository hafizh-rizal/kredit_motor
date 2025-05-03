<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCicilan extends Model
{
    use HasFactory;

    protected $table = 'jenis_cicilan'; 

    protected $fillable = [
        'lama_cicilan',
        'margin_kredit',
    ];

    public $timestamps = true;

    public function pengajuanKredits()
    {
        return $this->hasMany(PengajuanKredit::class, 'id_jenis_cicilan');
    }
}
