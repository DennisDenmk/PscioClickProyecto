<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Calendario de Citas</h1>

        <div id="calendar"></div>
    </div>

    <!-- Incluye FullCalendar y dependencias -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: '{{ route('citas.calendario.data') }}',
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.open(info.event.url, "_blank");
                }
            }
        });

        calendar.render();
    });
    </script>
</x-app-layout>
