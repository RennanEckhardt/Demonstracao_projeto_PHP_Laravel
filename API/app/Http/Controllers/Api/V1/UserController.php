<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

     public function ping()
     {
       return response()->json([
         'status' => 'sucesso',
         'mensagem' => 'O servidor está online e pronto para atender solicitações.',
         'horario' => 'Hora atual do servidor: ' . now()->toDayDateTimeString()
     ], 200);
     }
     
    public function index()
    {
        $users = User::all();
        return response()->json(['status' => 'sucesso', 'data' => $users], 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Usuário não encontrado.'], 404);
        }

        return response()->json(['status' => 'sucesso', 'data' => $user], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:users,cpf|max:14|min:11',
            'email' => 'required|string|email|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'erro', 'mensagem' => $validator->errors()], 400);
        }

        $user = User::create($request->all());

        return response()->json(['status' => 'sucesso', 'mensagem' => 'Usuário criado com sucesso.', 'data' => $user], 201);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:users,id',
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|min:11|unique:users,cpf,' . $request->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'erro', 'mensagem' => $validator->errors()], 400);
        }

        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Usuário não encontrado.'], 404);
        }

        $user->update($request->all());

        return response()->json(['status' => 'sucesso', 'mensagem' => 'Usuário atualizado com sucesso.', 'data' => new UserResource($user)], 200);
    }


    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'erro', 'mensagem' => $validator->errors()], 400);
        }

        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Usuário não encontrado.'], 404);
        }

        $user->delete();

        return response()->json(['status' => 'sucesso', 'mensagem' => 'Usuário excluído com sucesso.'], 200);
    }
}
