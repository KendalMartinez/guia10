<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso; 


class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $busqueda = $request->input('buscar');
    
    $cursos = Curso::when($busqueda, function ($query, $busqueda) {
        return $query->where('nombre', 'like', "%$busqueda%");
    })->get();

    return view('cursos.index', compact('cursos', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('cursos.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([ 
        'nombre' => 'required', 
        'duracion' => 'required|integer', 
            ]); 
 
    Curso::create($request->all()); 
    return redirect()->route('cursos.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required|integer',
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($request->all());

        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
