<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula; 

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
           $busqueda = $request->input('buscar');
    
    $aulas = Aula::when($busqueda, function ($query, $busqueda) {
        return $query->where('nombre', 'like', "%$busqueda%");
    })->get();

    return view('aulas.index', compact('aulas', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('aulas.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([ 
        'nombre' => 'required', 
        'capacidad' => 'required|integer', 
            ]); 
 
    Aula::create($request->all()); 
    return redirect()->route('aulas.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $aula = Aula::findOrFail($id);
        return view('aulas.show', compact('aula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aula = Aula::findOrFail($id);
        return view('aulas.edit', compact('aula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'capacidad' => 'required|integer',
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($request->all());

        return redirect()->route('aulas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();
        return redirect()->route('aulas.index');
    }
}
