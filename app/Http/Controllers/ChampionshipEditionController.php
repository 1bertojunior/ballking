<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChampionshipEditionStoreRequest;
use App\Http\Requests\ChampionshipEditionUpdateRequest;
use App\Models\ChampionshipEdition;
use App\Services\ChampionshipEditionServices;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChampionshipEditionController extends Controller
{
    public function __construct(protected ChampionshipEditionServices $championshipEditionServices)
    {}

    public function index()
    {
        try {
            Gate::authorize('viewAny', ChampionshipEdition::class);
            $championshipEditions = $this->championshipEditionServices->list();

            return response()->json($championshipEditions, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edição de Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ChampionshipEditionStoreRequest $request)
    {
        try {
            Gate::authorize('create', ChampionshipEdition::class);
            $championshipEdition = $this->championshipEditionServices->store($request);

            return response()->json($championshipEdition, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Edição de Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ChampionshipEdition $championshipEdition)
    {
        try {
            Gate::authorize('view', $championshipEdition);
            return response()->json($championshipEdition, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de Campeonato não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edição de Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ChampionshipEditionUpdateRequest $request, ChampionshipEdition $championshipEdition)
    {
        try {
            Gate::authorize('update', $championshipEdition);
            $championshipEdition = $this->championshipEditionServices->update($request, $championshipEdition);

            return response()->json($championshipEdition, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de Campeonato não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edição de Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ChampionshipEdition $championshipEdition)
    {
        try {
            Gate::authorize('delete', $championshipEdition);
            $this->championshipEditionServices->destroy($championshipEdition);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de Campeonato não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao deletar Edição de Campeonato.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
