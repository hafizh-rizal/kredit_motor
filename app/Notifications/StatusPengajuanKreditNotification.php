<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPengajuanKreditNotification extends Notification
{
    use Queueable;

    protected $pengajuan;

    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function via($notifiable)
    {
        return ['database']; 
    }

    public function toDatabase($notifiable)
    {
        return [
        'title' => 'Status Pengajuan Kredit Diperbarui',
        'message' => 'Status kini: ' . $this->pengajuan->status_pengajuan,
        'id_pengajuan' => $this->pengajuan->id,
        ];
    }
}
