<?php
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::post('/auth', [AuthController::class, 'login']);

Route::post('/ping', [UserController::class, 'ping']);

Route::get('/user', [UserController::class, 'index']);

//ROTAS PROTEGIDAS PELO TOKEN
Route::middleware('auth:sanctum')->group(function () {

  Route::get('/user/{id}', [UserController::class, 'show']);

  Route::post('/user', [UserController::class, 'store']);

  Route::put('/user', [UserController::class, 'update']);

  Route::delete('/user', [UserController::class, 'destroy']);

});