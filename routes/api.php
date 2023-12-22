<?php

use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:api','candidat'])->group(function(){
    Route::get('/dashboardCandidat',[UserController::class,'dashboardCandidat']);
    Route::post('/candidater/{formation}',[CandidatureController::class,'store']);
    Route::get('/logout',[UserController::class,'logout']);
});

Route::middleware(['auth:api','admin'])->group(function(){
    Route::get('/dashboardAdmin',[UserController::class,'dashboardAdmin']);
    Route::post('/creerFormation',[FormationController::class,'store']);
    Route::get('/listeCandidat',[UserController::class,'listeCandidat']);
    Route::get('/listeCandidature',[CandidatureController::class,'listeCandidature']);
    Route::post('/modifierFormation/{formation}',[FormationController::class,'update']);
    Route::delete('/supprimerFormation/{formation}',[FormationController::class,'destroy']);
    Route::post('/accepter/{candidature}',[CandidatureController::class,'accepter']);
    Route::post('/refuser/{candidature}',[CandidatureController::class,'refuser']);
    Route::get('/listeAccepter',[CandidatureController::class,'listeAccepter']);
    Route::get('/listeRefuser',[CandidatureController::class,'listeRefuser']);
    Route::get('/listeEnAttente',[CandidatureController::class,'index']);
    Route::get('/logout',[UserController::class,'logout']);
});

Route::get('/listeFormation',[FormationController::class,'index']);

Route::post('/register',[UserController::class,'store']);

Route::post('/login',[UserController::class,'login']);