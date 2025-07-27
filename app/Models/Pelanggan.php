<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'kata_kunci',
        'no_telp',
        'alamat1', 'kota1', 'propinsi1', 'kodepos1',
        'alamat2', 'kota2', 'propinsi2', 'kodepos2',
        'alamat3', 'kota3', 'propinsi3', 'kodepos3',
        'foto'
    ];

    protected $hidden = ['kata_kunci'];

    public function getAuthPassword()
    {
        return $this->kata_kunci;
    }
}
