<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RolesController extends Controller
{
    public function index()
    {
        try {
            $Roles = Roles::all();
            return response()->json($Roles, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar regras.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        // VALIDATE

        try {
            $Roles = Roles::create($request->all());
            return response()->json($Roles, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar Regras.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $Roles = Roles::findOrFail($id);
            return response()->json($Roles, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Regra não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar Regra.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, Roles $Roles, int $id)
    {
        // VALIDATE
        try {
            $Roles = Roles::findOrFail($id);
            $Roles->update($request->all());
            return response()->json($Roles, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Regras não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar Regras.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $Roles = Roles::findOrFail($id);
            $Roles->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Regras não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar Regras.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
