<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundStoreRequest;
use App\Http\Requests\RoundUpdateRequest;
use App\Models\Round;
use App\Services\RoundServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoundController extends Controller
{
    public function __construct(protected RoundServices $roundServices)
    {}
   
    public function index()
    {
        try {
            Gate::authorize('viewAny', Round::class);
            $rounds = $this->roundServices->list();
            return response()->json($rounds, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Rodadas.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(RoundStoreRequest $request)
    {
        try {
            Gate::authorize('create', Round::class);
            $round = $this->roundServices->store($request);
            return response()->json($round, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Round $round)
    {
        try {
            Gate::authorize('view', $round);
            return response()->json($round, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Rodada não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Rodada .',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(RoundUpdateRequest $request, Round $round)
    {
        try {
            Gate::authorize('update', $round);
            $round = $this->roundServices->update($request, $round);
            return response()->json($round, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Rodada não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Round $round)
    {
        try {
            Gate::authorize('delete', $round);
            $this->roundServices->destroy($round);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Rodada não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Rodada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
