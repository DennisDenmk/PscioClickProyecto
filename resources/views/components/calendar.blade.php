{{-- resources/views/components/calendar.blade.php --}}
@props(['route' => 'citas.calendario'])

<div class="calendario-container">
    <div id="calendar"></div>

    <div id="citaModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Detalles de la Cita</h3>
                <button type="button" class="modal-close" onclick="cerrarModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detalle-grupo">
                    <label>Estado:</label>
                    <span id="modalEstado" class="estado-badge"></span>
                </div>
                <div class="detalle-grupo">
                    <label>Doctor:</label>
                    <span id="modalDoctor"></span>
                </div>
                <div class="detalle-grupo">
                    <label>Paciente:</label>
                    <span id="modalPaciente"></span>
                </div>
                <div class="detalle-grupo">
                    <label>Tipo de Cita:</label>
                    <span id="modalTipo"></span>
                </div>
                <div class="detalle-grupo">
                    <label>Teléfono:</label>
                    <span id="modalTelefono"></span>
                </div>
                <div class="detalle-grupo" id="observacionesGrupo" style="display: none;">
                    <label>Observaciones:</label>
                    <span id="modalObservaciones"></span>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalEditarCita" href="#"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Editar
                </a>
                <a id="modalVerCita" href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Ver
                </a>
                <button onclick="cerrarModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos del calendario */
    .calendario-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px 0;
    }

    /* Estilos de estados usando tu paleta de colores */
    .fc-event.pendiente {
        background-color: #c8e6dc !important;
        border-color: #7bb899 !important;
        color: #1a5555 !important;
    }

    .fc-event.confirmada {
        background-color: #7bb899 !important;
        border-color: #2d7a6b !important;
        color: white !important;
    }

    .fc-event.cancelada {
        background-color: #f8fcfa !important;
        border-color: #c8e6dc !important;
        color: #1a5555 !important;
        opacity: 0.7;
        text-decoration: line-through;
    }

    .fc-event.completada {
        background-color: #1a5555 !important;
        border-color: #2d7a6b !important;
        color: white !important;
    }

    /* Personalización adicional del calendario */
    .fc-toolbar-title {
        color: #1a5555 !important;
        font-weight: 600;
    }

    .fc-button-primary {
        background-color: #2d7a6b !important;
        border-color: #2d7a6b !important;
    }

    .fc-button-primary:hover {
        background-color: #1a5555 !important;
        border-color: #1a5555 !important;
    }

    .fc-button-primary:not(:disabled):active {
        background-color: #1a5555 !important;
        border-color: #1a5555 !important;
    }

    .fc-today-button {
        background-color: #7bb899 !important;
        border-color: #7bb899 !important;
    }

    .fc-daygrid-day.fc-day-today {
        background-color: #f8fcfa !important;
    }

    /* Estilos del modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        margin: 0;
        color: #1a5555;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #6b7280;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close:hover {
        color: #1a5555;
    }

    .modal-body {
        padding: 20px;
    }

    .detalle-grupo {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detalle-grupo label {
        font-weight: 600;
        color: #1a5555;
        font-size: 0.875rem;
    }

    .detalle-grupo span {
        color: #374151;
    }

    .estado-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
    }

    .estado-badge.pendiente {
        background-color: #c8e6dc;
        color: #1a5555;
    }

    .estado-badge.confirmada {
        background-color: #7bb899;
        color: white;
    }

    .estado-badge.cancelada {
        background-color: #f8fcfa;
        color: #1a5555;
        border: 1px solid #c8e6dc;
    }

    .estado-badge.completada {
        background-color: #1a5555;
        color: white;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-primary {
        background-color: #2d7a6b;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1a5555;
    }

    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .calendario-container {
            padding: 15px;
            margin: 10px 0;
        }

        .modal-content {
            width: 95%;
            margin: 20px;
        }

        .fc-toolbar {
            flex-direction: column;
            gap: 10px;
        }

        .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
        }
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            },
            height: 'auto',
            events: '{{ route('citas.calendario.data') }}',
            eventDisplay: 'block',
            dayMaxEvents: 3,
            eventClick: function(info) {
                mostrarDetallesCita(info.event);
                info.jsEvent.preventDefault();
            },
            eventDidMount: function(info) {
                // Añadir clase CSS basada en el estado
                if (info.event.extendedProps.estado) {
                    info.el.classList.add(info.event.extendedProps.estado);
                }
            },
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            }
        });

        calendar.render();

        // Función para mostrar detalles de la cita
        window.mostrarDetallesCita = function(event) {
            const modal = document.getElementById('citaModal');
            const props = event.extendedProps;

            document.getElementById('modalTitle').textContent = event.title;

            const estadoBadge = document.getElementById('modalEstado');
            estadoBadge.textContent = props.estadoTexto;
            estadoBadge.className = `estado-badge ${props.estado}`;

            document.getElementById('modalDoctor').textContent = props.doctor;
            document.getElementById('modalPaciente').textContent = props.paciente;
            document.getElementById('modalTipo').textContent = props.tipo;
            document.getElementById('modalTelefono').textContent = props.telefono;

            const observacionesGrupo = document.getElementById('observacionesGrupo');
            const observacionesSpan = document.getElementById('modalObservaciones');

            if (props.observaciones && props.observaciones.trim() !== '') {
                observacionesSpan.textContent = props.observaciones;
                observacionesGrupo.style.display = 'flex';
            } else {
                observacionesGrupo.style.display = 'none';
            }

            document.getElementById('modalVerCita').href = event.url;
            document.getElementById('modalEditarCita').href = event.extendedProps.edit;

            modal.style.display = 'flex';
        };

        // Función para cerrar modal
        window.cerrarModal = function() {
            document.getElementById('citaModal').style.display = 'none';
        };

        // Cerrar modal al hacer clic fuera
        document.getElementById('citaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });
    });
</script>
