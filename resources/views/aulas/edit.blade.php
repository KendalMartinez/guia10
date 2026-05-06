<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Editar Aula</h2>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aulas.update', $aula->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre del Aula</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ old('nombre', $aula->nombre) }}">
            </div>

            <!-- Capacidad -->
            <div class="mb-3">
                <label class="form-label">Capacidad</label>
                <input type="number"
                       name="capacidad"
                       class="form-control"
                       value="{{ old('capacidad', $aula->capacidad) }}">
            </div>

            <!-- Cursos (RELACIÓN 🔥) -->
            <div class="mb-3">
                <label class="form-label">Asignar Cursos</label>

                <select name="cursos[]" class="form-select" multiple>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}"
                            {{ 
                                (collect(old('cursos', $aula->cursos->pluck('id')))
                                ->contains($curso->id)) ? 'selected' : '' 
                            }}>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>

                <small class="text-muted">
                    Mantén presionado Ctrl (o Cmd) para seleccionar varios
                </small>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('aulas.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <button type="submit" class="btn btn-success">
                    Actualizar
                </button>
            </div>

        </form>

    </div>

</div>