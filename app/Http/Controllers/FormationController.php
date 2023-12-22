<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;




class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formation= Formation::all();

        if($formation){
            return response()->json([
                "status"=>true,
                "message"=> "Liste des Formations",
                "data"=>$formation
            ]);
        }
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

       /**
     * @OA\Post(
     *     path="/creerFormation",
     *     tags={"Formation"},
     *     summary="Cette route permet de creer une formation",
     *     @OA\Response(response="201", description="Formation Creer avec succès")
     * )
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

       /**
     * @OA\Post(
     *     path="/modifierFormation/{formation}",
     *     tags={"Formation"},
     *     summary="Cette route permet de modifier une formation",
     *      @OA\Parameter(
     *         name="formation",
     *         in="path",
     *         required=true,
     *         description="ID formation",
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="Formation modifier avec succès")
     * )
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

        /**
     * @OA\Delete(
     *     path="/supprimerFormation/{formation}",
     *     tags={"Formation"},
     *     summary="Cette route permet de supprimer une formation",
     *      @OA\Parameter(
     *         name="formation",
     *         in="path",
     *         required=true,
     *         description="ID formation",
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="Formation supprimer avec succès")
     * )
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
