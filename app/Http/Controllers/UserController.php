<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use OpenApi\Annotations as OA;


class UserController extends Controller
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

       /**
     * @OA\Post(
     *     path="/register",
     *     tags={"User"},
     *     summary="Cette route permet d'enregistrer un candidat ",
     *     @OA\Response(response="201", description="Candidat Creer avec succès")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Admin,Candidat',
        ]);

       $user= new User();
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->telephone = $request->input('telephone');
       $user->password = bcrypt($request->input('password'));
       $user->role = $request->input('role', 'Candidat');

       if($user->save()){
        return response()->json([
            "status" =>true,
            "message" => "Candidat créer avec Succès",
            "data" => $user
        ]);
       }

       
    }

     /**
     * @OA\Post(
     *     path="/login",
     *      tags={"User"},
     *     summary="Cette route permet de connecter un candidat ou un administrateur ",
     *     @OA\Response(response="201", description="Vous êtes connecté avec succès")
     * )
     */

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json(['status' => 0, 'message' => 'Identifiants invalides'], 401);
    }

    // try {
    //     if (! $token = JWTAuth::attempt($credentials)) {
    //         return response()->json(['status' => 0, 'message' => 'Identifiants invalides'], 401);
    //     }
    // } catch (JWTException $e) {
    //     return response()->json(['status' => 0, 'message' => 'Erreur lors de la création du token'], 500);
    // }

    $user = JWTAuth::user();

    $role = $user->role;

    if ($role === 'Admin') {
        $message = 'Vous êtes connecté en tant qu\'administrateur';
    } elseif ($role === 'Candidat') {
        $message = 'Vous êtes connecté en tant que candidat';
    } 

    return response()->json([
        'status' => 1,
        'message' => $message,
        'token' => $token,
        'role' => $role,
        'datas' => $user,
    ]);
}

   /**
     * @OA\Get(
     *     path="/dashboardAdmin",
     *     tags={"User"},
     *     summary="Cette route permet de rediger un administrateur à son dahsboard une fois qu'il est connecté ",
     *     @OA\Response(response="200", description="Bienvenue à votre dashboard")
     * )
     */
   
public function dashboardAdmin(){
    $user= auth()->user();

    return response()->json([
        "message"=>"vous êtes connecter en tant que Administrateur",
        "data"=>$user
    ]);
}

  /**
     * @OA\Get(
     *     path="/dashboardCandidat",
     *     tags={"User"},
     *     summary="Cette route permet de rediger un candidat à son dahsboard une fois qu'il est connecté ",
     *     @OA\Response(response="200", description="Bienvenue à votre dashboard")
     * )
     */

public function dashboardCandidat(){
    $user= auth()->user();

    return response()->json([
        "message"=>"vous êtes connecter en tant que Candidat",
        "data"=>$user
    ]);
}

  /**
     * @OA\Get(
     *     path="/logout",
     *     tags={"User"},
     *     summary="Cette route permet de deconnecter un candidat ou un administrateur ",
     *     @OA\Response(response="200", description="Vous êtes deconnectez")
     * )
     */

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Déconnexion effectuer avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
