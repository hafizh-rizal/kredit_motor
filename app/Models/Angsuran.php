<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $fillable = [
        'id_kredit', 
        'tgl_bayar', 
        'angsuran_ke', 
        'bukti_pembayaran',
        'total_bayar', 
        'status_pembayaran',
        'keterangan'
    ];

    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'id_kredit');
    }
}
