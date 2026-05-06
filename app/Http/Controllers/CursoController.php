<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Aula;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $cursos = Curso::with('aulas')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('nombre', 'like', "%$busqueda%");
            })->get();

        return view('cursos.index', compact('cursos', 'busqueda'));
    }

    public function create()
    {
        $aulas = Aula::all();
        return view('cursos.create', compact('aulas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required|integer',
            'aulas' => 'array'
        ]);

        $curso = Curso::create($request->only('nombre', 'duracion'));

        if ($request->has('aulas')) {
            $curso->aulas()->attach($request->aulas);
        }

        return redirect()->route('cursos.index');
    }

    public function show(string $id)
    {
        $curso = Curso::with('aulas')->findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    public function edit(string $id)
    {
        $curso = Curso::findOrFail($id);
        $aulas = Aula::all();

        return view('cursos.edit', compact('curso', 'aulas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required|integer',
            'aulas' => 'array'
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($request->only('nombre', 'duracion'));

        $curso->aulas()->sync($request->aulas ?? []);

        return redirect()->route('cursos.index');
    }

    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index');
    }
}