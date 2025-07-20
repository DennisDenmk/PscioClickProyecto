<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CitaAsignada extends Notification
{
    use Queueable;

    public $cita;

    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => 'Se le ha asignado una nueva cita.',
            'fecha' => $this->cita['fecha'],
            'hora' => $this->cita['hora'],
            'paciente' => $this->cita['paciente'],
            'motivo' => $this->cita['motivo'],
            'url' =>  $this->cita['id'],
        ];
    }
}
