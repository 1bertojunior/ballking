<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundTypeStoreRequest;
use App\Http\Requests\RoundTypeUpdateRequest;
use App\Models\RoundType;
use App\Services\RoundTypeServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoundTypeController extends Controller
{
    public function __construct(protected RoundTypeServices $roundTypeServices)
    {}
   
    public function index()
    {
        try {
            Gate::authorize('viewAny', RoundType::class);
            $roundTypes = $this->roundTypeServices->list();
            return response()->json($roundTypes, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Tipos de Rodadas.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(RoundTypeStoreRequest $request)
    {
        try {
            Gate::authorize('create', RoundType::class);
            $roundType = $this->roundTypeServices->store($request);
            return response()->json($roundType, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Tipo de Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(RoundType $roundType)
    {
        try {
            Gate::authorize('view', $roundType);
            return response()->json($roundType, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de Rodada não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Tipo de Rodada .',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(RoundTypeUpdateRequest $request, RoundType $roundType)
    {
        try {
            Gate::authorize('update', $roundType);
            $roundType = $this->roundTypeServices->update($request, $roundType);
            return response()->json($roundType, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de Rodada não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Tipo de Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(RoundType $roundType)
    {
        try {
            Gate::authorize('delete', $roundType);
            $this->roundTypeServices->destroy($roundType);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de Rodada não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Tipo de Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
