<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
   
    public function index()
    {
        try {
            $Users = User::all();
            return response()->json($Users, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar Usuários.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
    }

    public function show(int $id)
    {
        try {
            $User = User::findOrFail($id);
            return response()->json($User, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar Usuário.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, User $User, int $id)
    {
        // VALIDATE
        try {
            $User = User::findOrFail($id);
            $User->update($request->all());
            return response()->json($User, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar Usuário.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $User = User::findOrFail($id);
            $User->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar Usuário.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
