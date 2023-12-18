<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'durer' => 'required|string',
        ]);

        $formation = new Formation();
        $formation->nom=$request->nom;
        $formation->description=$request->description;
        $formation->durer=$request->durer;

        if($formation->save()){
            return response()->json([
                "status"=>true,
                "message"=> "Formation créer avec succès",
                "data"=>$formation
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'durer' => 'required|string',
        ]);

        $formation->nom= $request->nom;
        $formation->description= $request->description;
        $formation->durer= $request->durer;

        if($formation->update()){
            return response()->json([
                "status"=>true,
                "message"=> "Formation modifiée avec succès",
                "data"=>$formation
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        if($formation->delete()){
            return response()->json([
                "status"=>true,
                "message"=> "Suppression effectuer avec succès",
                "data"=>$formation
            ]);
        }
    }
}
