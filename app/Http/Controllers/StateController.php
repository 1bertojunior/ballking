<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateController extends Controller
{
   
    public function index()
    {
        try {
            $states = State::all();
            return response()->json($states, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar estados.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        // VALIDATE

        try {
            $state = State::create($request->all());
            return response()->json($state, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar estado.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $state = State::findOrFail($id);
            return response()->json($state, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Estado não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar estado.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, State $state, int $id)
    {
        // VALIDATE
        try {
            $state = State::findOrFail($id);
            $state->update($request->all());
            return response()->json($state, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Estado não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar estado.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $state = State::findOrFail($id);
            $state->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Estado não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar estado.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
