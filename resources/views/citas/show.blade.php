<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Detalle de Cita #{{ $cita->cit_id }}</h1>

        <div class="bg-white shadow rounded p-6">
            <p><strong>Paciente:</strong> {{ $cita->paciente->pac_nombres }} {{ $cita->paciente->pac_apellidos }}</p>
            <p><strong>Cédula:</strong> {{ $cita->paciente->pac_cedula }}</p>
            <p><strong>Doctor:</strong> {{ $cita->doctor->doc_nombres ?? 'N/A' }}</p>
            <p><strong>Tipo de Cita:</strong> {{ $cita->tipoCita->tipc_nombre }}</p>
            <p><strong>Estado:</strong> {{ $cita->estadoCita->estc_nombre ?? 'Sin estado' }}</p>
            <p><strong>Fecha:</strong> {{ $cita->cit_fecha }}</p>
            <p><strong>Hora Inicio:</strong> {{ $cita->cit_hora_inicio }}</p>
            <p><strong>Hora Fin:</strong> {{ $cita->cit_hora_fin }}</p>
            <p><strong>Motivo:</strong> {{ $cita->cit_motivo_consulta }}</p>
        </div>
    </div>
</x-app-layout>
