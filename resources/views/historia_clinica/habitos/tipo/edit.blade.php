<x-app-layout>
 <div class="container">
    <h1>Editar Tipo de Hábito</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipo_habito.update', $tipo->tipo_hab_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="tipo_hab_nombre" class="form-label">Nombre</label>
            <input type="text" name="tipo_hab_nombre" id="tipo_hab_nombre" class="form-control" value="{{ $tipo->tipo_hab_nombre }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tipo_habito.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-app-layout>
