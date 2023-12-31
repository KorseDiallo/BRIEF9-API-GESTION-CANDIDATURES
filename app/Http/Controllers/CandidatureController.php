<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Formation;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      /**
     * @OA\Get(
     *     path="/listeEnAttente",
     *     tags={"Candidature"},
     *     
     *     summary="Cette route permet de voir toutes les candidatures en attente",
     *     @OA\Response(response="200", description="succes")
     * )
     */
    public function index()
    {
        $listeEnattente = Candidature::where("status","enattente")->get();

        return response()->json([
            "status"=>true,
            "message"=> "Liste de tous les candidats en attente",
            "data"=>$listeEnattente
        ]);
    }

     /**
     * @OA\Get(
     *     path="/listeAccepter",

     *  tags={"Candidature"},         
     *     summary="Cette route permet de voir toutes les candidatures accepter",
     *     @OA\Response(response="200", description="succes")
     * )
     */

    public function listeAccepter(){
        $listesAccepter = Candidature::where("status","accepter")->get();

        return response()->json([
            "status"=>true,
            "message"=> "Liste de tous les candidats accepter",
            "data"=>$listesAccepter
        ]);
    }

      /**
     * @OA\Get(
     *     path="/listeRefuser",
 
     *   tags={"Candidature"},  
      *     summary="Cette route permet de voir toutes les candidatures refuser",
     *     @OA\Response(response="200", description="succes")
     * )
     */

    public function listeRefuser(){
        $listesRefuser = Candidature::where("status","refuser")->get();

        return response()->json([
            "status"=>true,
            "message"=> "Liste de tous les candidats refuser",
            "data"=>$listesRefuser 
        ]);
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
     *     path="/candidater/{formation}",
   
       *   tags={"Candidature"},  
      *     summary="Cette route permet à un candidat de candidater à une formation",
     *       @OA\Parameter(
     *         name="formation",
     *         in="path",
     *         required=true,
     *         description="ID formation",
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="Candidature envoyer avec succès")
     * )
     */
    public function store(Formation $formation)
{
    $userAuth = auth()->user()->id;

    // Vérifier si l'utilisateur a déjà candidaté à cette formation
    $candidat = Candidature::where('formation_id', $formation->id)
        ->where("user_id", $userAuth)
        ->first();

    if (!$candidat) {
        $candidature = new Candidature();
        $candidature->user_id = $userAuth;
        $candidature->formation_id = $formation->id;

        if ($candidature->save()) {
            return response()->json([
                "status" => true,
                "message" => "Candidature envoyée avec succès",
                "data" => $candidature
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Erreur lors de l'enregistrement de la candidature",
            ]);
        }
    } else {
        return response()->json([
            "status" => false,
            "message" => "Vous avez déjà candidaté à la formation " 
        ]);
    }
}


     /**
     * @OA\Post(
     *     path="/accepter/{candidature}",
     *    tags={"Candidature"},
     *     summary="Cette route permet d'accepter une candidature",
     *      @OA\Parameter(
     *         name="candidature",
     *         in="path",
     *         required=true,
     *         description="ID candidature",
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="candidature accepter avec succès")
     * )
     */

    public function accepter(Candidature $candidature)
    {
        // dd($candidature);
        if ($candidature->status === 'enattente' || $candidature->status==='refuser') {
            $candidature->status = 'accepter';
    
            if ($candidature->save()) {
                return response()->json([
                    "status" => true,
                    "message" => "Candidature acceptée avec succès"
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Erreur lors de la mise à jour du statut de la candidature"
                ], 500); 
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "La candidature n'est pas en attente, impossible de l'accepter"
            ], 422); 
        }
    }
    
     /**
     * @OA\Post(
     *     path="/refuser/{candidature}",
     *    tags={"Candidature"},
     *     summary="Cette route permet de refuser une candidature",
     *      @OA\Parameter(
     *         name="candidature",
     *         in="path",
     *         required=true,
     *         description="ID candidature",
     *         @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="201", description="candidature refuser avec succès")
     * )
     */

    public function refuser(Candidature $candidature)
    {
        if ($candidature->status === 'enattente' || $candidature->status==='accepter') {
            $candidature->status = 'refuser';
    
            if ($candidature->save()) {
                return response()->json([
                    "status" => true,
                    "message" => "Candidature refuser avec succès"
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Erreur lors de la mise à jour du statut de la candidature"
                ], 500); 
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "La candidature n'est pas en attente, impossible de refuser"
            ], 422); 
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Candidature $candidature)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidature $candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
}
