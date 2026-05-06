@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Lista de Cursos</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <!-- Buscador -->
            <form method="GET" action="{{ route('cursos.index') }}" class="d-flex">
                <div class="input-group">
                    <input type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar curso..."
                        value="{{ $busqueda ?? '' }}">

                    <button class="btn btn-primary" type="submit">
                        Buscar
                    </button>

                    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                        Limpiar
                    </a>
                </div>
            </form>

            <!-- Crear -->
            <a href="{{ route('cursos.create') }}" class="btn btn-success ms-3">
                + Crear nuevo curso
            </a>

        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Duración</th>
                        <th>Aulas</th> <!-- 🔥 relación -->
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($cursos as $curso)
                    <tr>
                        <td>{{ $curso->id }}</td>
                        <td>{{ $curso->nombre }}</td>
                        <td>{{ $curso->duracion }} hrs</td>

                        <!-- 🔥 Mostrar aulas -->
                        <td>
                            @if($curso->aulas->isEmpty())
                                <span class="text-muted">Sin aulas</span>
                            @else
                                @foreach($curso->aulas as $aula)
                                    <span class="badge bg-success">
                                        {{ $aula->nombre }}
                                    </span>
                                @endforeach
                            @endif
                        </td>

                        <td>
                            <!-- Ver -->
                            <a href="{{ route('cursos.show', $curso->id) }}"
                                class="btn btn-info btn-sm">
                                Ver más
                            </a>

                            <!-- Editar -->
                            <a href="{{ route('cursos.edit', $curso->id) }}"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('cursos.destroy', $curso->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este curso?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No hay cursos registrados</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection