@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Crear Nuevo Curso</h2>

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

        <form action="{{ route('cursos.store') }}" method="POST">
            @csrf

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre del Curso</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ old('nombre') }}">
            </div>

            <!-- Duración -->
            <div class="mb-3">
                <label class="form-label">Duración</label>
                <input type="number"
                       name="duracion"
                       class="form-control"
                       value="{{ old('duracion') }}">
            </div>

            <!-- 🔥 AULAS -->
            <div class="mb-3">
                <label class="form-label">Asignar Aulas</label>

                <select name="aulas[]" class="form-select" multiple>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}"
                            {{ (collect(old('aulas'))->contains($aula->id)) ? 'selected' : '' }}>
                            {{ $aula->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <button class="btn btn-success">
                    Guardar Curso
                </button>
            </div>

        </form>

    </div>

</div>

@endsection