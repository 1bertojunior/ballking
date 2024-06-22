<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Models\City;
use App\Services\CityServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

class CityController extends Controller
{
    public function __construct(protected CityServices $cityServices)
    {}

    public function index()
    {
        try {
            Gate::authorize('viewAny', City::class);
            $citys = $this->cityServices->list();
            return response()->json($citys, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar cidades.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CityStoreRequest $request)
    {
        try {
            $city = $this->cityServices->store($request);

            return response()->json($city, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar cidade.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(City $city)
    {
        try {
            return response()->json($city, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Cidade não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Cidade.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CityUpdateRequest $request, City $city)
    {
        try {
            $city = $this->cityServices->update($request, $city);

            return response()->json($city, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Cidade não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Cidade.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(City $city)
    {
        try {
            $this->cityServices->destroy($city);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Cidade não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Cidade.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
