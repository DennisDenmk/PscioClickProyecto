<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CitaActualizada extends Notification
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
        // Determinar el mensaje según el tipo de acción
        $accion = $this->cita['accion'] ?? 'actualizada';
        $mensaje = $this->getMensajePorAccion($accion);

        return [
            'cita_id' => $this->cita['cita_id'],
            'mensaje' => $mensaje,
            'fecha' => $this->cita['fecha'],
            'hora' => $this->cita['hora'],
            'paciente' => $this->cita['paciente'],
            'motivo' => $this->cita['motivo'] ?? null,
            'accion' => $accion,
            'tipo_notificacion' => $this->cita['tipo_notificacion'] ?? 'actualizacion',
            'url' => url("/citas/{$this->cita['cita_id']}"),
        ];
    }

    private function getMensajePorAccion($accion)
    {
        switch ($accion) {
            case 'editada':
                return 'Una cita asignada a ti ha sido modificada. Revisa los nuevos detalles.';
            case 'cancelada':
                return 'Una cita asignada a ti ha sido cancelada.';
            case 'reprogramada':
                return 'Una cita asignada a ti ha sido reprogramada.';
            default:
                return 'Tu cita ha sido actualizada.';
        }
    }
}
