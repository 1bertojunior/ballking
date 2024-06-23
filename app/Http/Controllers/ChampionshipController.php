<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChampionshipStoreRequest;
use App\Http\Requests\ChampionshipUpdateRequest;
use App\Models\Championship;
use App\Services\ChampionshipServices;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChampionshipController extends Controller
{
    public function __construct(protected ChampionshipServices $championshipServices)
    {}

    public function index()
    {
        try {
            Gate::authorize('viewAny', Championship::class);
            $championships = $this->championshipServices->list();

            return response()->json($championships, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Campeonatos.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ChampionshipStoreRequest $request)
    {
        try {
            Gate::authorize('create', Championship::class);
            $championship = $this->championshipServices->store($request);

            return response()->json($championship, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Championship $championship)
    {
        try {
            Gate::authorize('view', $championship);
            return response()->json($championship, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Campeoonato não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ChampionshipUpdateRequest $request, Championship $championship)
    {
        try {
            Gate::authorize('update', $championship);
            $championship = $this->championshipServices->update($request, $championship);

            return response()->json($championship, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Campeonato não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Championship $championship)
    {
        try {
            Gate::authorize('delete', $championship);
            $this->championshipServices->destroy($championship);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Campeoanto não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao deletar Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
