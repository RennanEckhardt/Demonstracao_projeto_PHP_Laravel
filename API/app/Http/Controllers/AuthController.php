<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
      $credentials = $request->only('email', 'password');
  
      if (Auth::attempt($credentials)) {
          $user = Auth::user();
          $token = $user->createToken('authToken')->plainTextToken;
  
          return response()->json([
              'status' => 'success',
              'message' => 'Usuário autenticado com sucesso',
              'tokenjwt' => $token,
              'expires' => now()->addDay()->format('Y-m-d'),
              'tokenmsg' => 'Use o token para acessar os endpoints!',
              'User' => [
                  'id' => $user->id,
                  'nome' => $user->nome,
                  'cpf' => $user->cpf,
                  'email' => $user->email,
                  'createdAt' => $user->created_at->format('Y-m-d H:i:s'),
                  'updatedAt' => $user->updated_at->format('Y-m-d H:i:s')
              ]
          ], 200);
      }
  
      return response()->json([
          'status' => 'error',
          'message' => 'Usuário não pode ser autenticado!'
      ], 500);
  }
  
}
