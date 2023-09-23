<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alunoController;

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


Route::get('/', function(){
    return response()->json([
        'Success' => true
    ]);
});

Route::get('/aluno', [alunoController::class,'index']);
Route::get('/aluno/{id}',[alunoController::class,'show']);
Route::post('/aluno',[alunoController::class,'store']);
Route::delete('/aluno/{id}',[alunoController::class,'destroy']);
Route::put('/aluno/{id}',[alunoController::class,'update']);