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
            'cita_id' => $this->cita['cita_id'], // Cambiado de 'id' a 'cita_id'
            'mensaje' => 'Se le ha asignado una nueva cita.',
            'fecha' => $this->cita['fecha'],
            'hora' => $this->cita['hora'],
            'paciente' => $this->cita['paciente'],
            'motivo' => $this->cita['motivo'],
            'url' => url("/citas/{$this->cita['cita_id']}"), // URL más consistente
        ];
    }
}
