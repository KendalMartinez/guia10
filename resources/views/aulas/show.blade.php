<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Detalle del Aula</h2>

        <div class="mb-3">
            <strong>ID:</strong>
            <p>{{ $aula->id }}</p>
        </div>

        <div class="mb-3">
            <strong>Nombre:</strong>
            <p>{{ $aula->nombre }}</p>
        </div>

        <div class="mb-3">
            <strong>Capacidad:</strong>
            <p>{{ $aula->capacidad }}</p>
        </div>

        <!-- 🔥 CURSOS RELACIONADOS -->
        <div class="mb-3">
            <strong>Cursos asignados:</strong>

            @if($aula->cursos->isEmpty())
                <p class="text-muted mt-2">Esta aula no tiene cursos asignados</p>
            @else
                <div class="mt-2">
                    @foreach($aula->cursos as $curso)
                        <span class="badge bg-primary me-1">
                            {{ $curso->nombre }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-between mt-4">

            <!-- Volver -->
            <a href="{{ route('aulas.index') }}" class="btn btn-secondary">
                Volver
            </a>

            <!-- Acciones -->
            <div class="d-flex gap-2">

                <!-- Editar -->
                <a href="{{ route('aulas.edit', $aula->id) }}"
                    class="btn btn-warning btn-sm">
                    Editar
                </a>

                <!-- Eliminar -->
                <form action="{{ route('aulas.destroy', $aula->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Seguro que deseas eliminar este aula?')">
                        Eliminar
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>