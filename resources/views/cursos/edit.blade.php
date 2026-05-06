@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Editar Curso</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-3">
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ old('nombre', $curso->nombre) }}">
            </div>

            <!-- Duración -->
            <div class="mb-3">
                <input type="number"
                       name="duracion"
                       class="form-control"
                       value="{{ old('duracion', $curso->duracion) }}">
            </div>

            <!-- 🔥 AULAS -->
            <div class="mb-3">
                <label class="form-label">Asignar Aulas</label>

                <select name="aulas[]" class="form-select" multiple>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}"
                        {{ 
                            (collect(old('aulas', $curso->aulas->pluck('id')))
                            ->contains($aula->id)) ? 'selected' : '' 
                        }}>
                            {{ $aula->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Volver</a>
                <button class="btn btn-success">Actualizar</button>
            </div>

        </form>

    </div>

</div>

@endsection