<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Crear Nueva Aula</h2> 

        {{-- Mostrar errores de validación --}}
        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul class="mb-0"> 
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach 
                </ul> 
            </div>
        @endif 

        <form action="{{ route('aulas.store') }}" method="POST"> 
            @csrf 

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Aula</label> 
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       class="form-control"
                       value="{{ old('nombre') }}"
                       placeholder="Ej: Aula#1">
            </div>

            <!-- Capacidad -->
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label> 
                <input type="number" 
                       id="capacidad" 
                       name="capacidad" 
                       class="form-control"
                       value="{{ old('capacidad') }}"
                       placeholder="Ej: 40">
            </div>

            <!-- Cursos (RELACIÓN N:M 🔥) -->
            <div class="mb-3">
                <label class="form-label">Asignar Cursos</label>

                <select name="cursos[]" class="form-select" multiple>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}"
                            {{ (collect(old('cursos'))->contains($curso->id)) ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>

                <small class="text-muted">
                    Mantén presionado Ctrl (o Cmd en Mac) para seleccionar varios
                </small>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('aulas.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <button type="submit" class="btn btn-success">
                    Guardar Aula
                </button>
            </div>

        </form> 

    </div>

</div>