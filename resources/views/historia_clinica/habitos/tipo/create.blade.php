<x-app-layout>
<div class="container">
    <h1>Crear Tipo de Hábito</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipo_habito.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo_hab_nombre" class="form-label">Nombre</label>
            <input type="text" name="tipo_hab_nombre" id="tipo_hab_nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tipo_habito.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-app-layout>
