<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{
    public function index()
    {
        try {
            $Citys = City::all();
            return response()->json($Citys, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar cidades.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        // VALIDATE

        try {
            $City = City::create($request->all());
            return response()->json($City, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar cidade.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $City = City::findOrFail($id);
            return response()->json($City, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cidade não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar Cidade.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, City $City, int $id)
    {
        // VALIDATE
        try {
            $City = City::findOrFail($id);
            $City->update($request->all());
            return response()->json($City, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cidade não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar Cidade.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $City = City::findOrFail($id);
            $City->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cidade não encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar Cidade.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
