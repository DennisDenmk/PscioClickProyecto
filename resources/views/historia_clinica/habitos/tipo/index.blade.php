<x-app-layout>
<div class="container">
    <h1>Tipos de Hábito</h1>
    <a href="{{ route('tipo_habito.create') }}" class="btn btn-primary mb-3">Nuevo Tipo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->tipo_hab_id }}</td>
                    <td>{{ $tipo->tipo_hab_nombre }}</td>
                    <td>
                        <a href="{{ route('tipo_habito.edit', $tipo->tipo_hab_id) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
