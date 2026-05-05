 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

 <div class="container mt-5">

     <div class="card shadow p-4">
         <h2 class="text-center mb-4">Detalle del Curso</h2>

         <div class="mb-3">
             <strong>ID:</strong>
             <p>{{ $curso->id }}</p>
         </div>

         <div class="mb-3">
             <strong>Nombre:</strong>
             <p>{{ $curso->nombre }}</p>
         </div>

         <div class="mb-3">
             <strong>Duración:</strong>
             <p>{{ $curso->duracion }} horas</p>
         </div>

         <div class="d-flex justify-content-between mt-4">

             <!-- Volver -->
             <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                 Volver
             </a>

             <!-- Acciones -->
             <div class="d-flex gap-2">

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

             </div>

         </div>

     </div>

 </div>