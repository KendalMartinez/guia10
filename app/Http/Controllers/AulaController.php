<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Curso;

class AulaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $aulas = Aula::with('cursos')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('nombre', 'like', "%$busqueda%");
            })->get();

        return view('aulas.index', compact('aulas', 'busqueda'));
    }

    public function create()
    {
        $cursos = Curso::all(); // 👈 necesario
        return view('aulas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'capacidad' => 'required|integer',
            'cursos' => 'array'
        ]);

        $aula = Aula::create($request->only('nombre', 'capacidad'));

        // guardar relación
        if ($request->has('cursos')) {
            $aula->cursos()->attach($request->cursos);
        }

        return redirect()->route('aulas.index');
    }

    public function show(string $id)
    {
        $aula = Aula::with('cursos')->findOrFail($id);
        return view('aulas.show', compact('aula'));
    }

    public function edit(string $id)
    {
        $aula = Aula::findOrFail($id);
        $cursos = Curso::all();

        return view('aulas.edit', compact('aula', 'cursos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'capacidad' => 'required|integer',
            'cursos' => 'array'
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($request->only('nombre', 'capacidad'));

        // sincronizar relación
        $aula->cursos()->sync($request->cursos ?? []);

        return redirect()->route('aulas.index');
    }

    public function destroy(string $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        return redirect()->route('aulas.index');
    }
}