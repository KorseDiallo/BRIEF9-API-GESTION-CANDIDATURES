<?php

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
    Route::get('/logout',[UserController::class,'logout']);
});

Route::middleware(['auth:api','admin'])->group(function(){
    Route::get('/dashboardAdmin',[UserController::class,'dashboardAdmin']);
    Route::get('/logout',[UserController::class,'logout']);
});

Route::post('/creerFormation',[FormationController::class,'store']);
Route::post('/modifierFormation/{formation}',[FormationController::class,'update']);
Route::delete('/supprimerFormation/{formation}',[FormationController::class,'destroy']);

Route::post('/register',[UserController::class,'store']);

Route::post('/login',[UserController::class,'login']);