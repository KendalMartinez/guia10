@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Lista de Aulas</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <!-- Buscador (izquierda) -->
            <form method="GET" action="{{ route('aulas.index') }}" class="d-flex">
                <div class="input-group">
                    <input type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar aula..."
                        value="{{ $busqueda ?? '' }}">

                    <button class="btn btn-primary" type="submit">
                        Buscar
                    </button>

                    <a href="{{ route('aulas.index') }}" class="btn btn-secondary">
                        Limpiar
                    </a>
                </div>
            </form>

            <!-- Botón crear (derecha) -->
            <a href="{{ route('aulas.create') }}" class="btn btn-success ms-3">
                + Crear nueva aula
            </a>

        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($aulas as $aula)
                    <tr>
                        <td>{{ $aula->id }}</td>
                        <td>{{ $aula->nombre }}</td>
                        <td>{{ $aula->capacidad }}</td>

                        <td>
                            <!-- Ver detalle -->
                            <a href="{{ route('aulas.show', $aula->id) }}"
                                class="btn btn-info btn-sm">
                                Ver más
                            </a>

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
                                    onclick="return confirm('¿Seguro que deseas eliminar esta aula?')">
                                    Eliminar
                                </button>
                            </form>


                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No hay aulas registradas</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection