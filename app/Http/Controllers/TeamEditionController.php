<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamEditionStoreRequest;
use App\Http\Requests\TeamEditionUpdateRequest;
use App\Models\TeamEdition;
use App\Services\TeamEditionServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TeamEditionController extends Controller
{

    public function __construct(protected TeamEditionServices $teamEditionServices)
    {}

    public function index()
    {
        try {
            Gate::authorize('viewAny', TeamEdition::class);
            $teamEdition = $this->teamEditionServices->list();

            return response()->json($teamEdition, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edições de Equipes.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(TeamEditionStoreRequest $request)
    {
        try {
            Gate::authorize('create', TeamEdition::class);
            $teamEdition = $this->teamEditionServices->store($request);

            return response()->json($teamEdition, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Edição de Equipe.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(TeamEdition $teamEdition)
    {
        try {
            Gate::authorize('view', $teamEdition);
            return response()->json($teamEdition, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de Equipe não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edição de Equipe.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(TeamEditionUpdateRequest $request, TeamEdition $teamEdition)
    {
        try {
            Gate::authorize('update', $teamEdition);
            $teamEdition = $this->teamEditionServices->update($request, $teamEdition);

            return response()->json($teamEdition, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de equipe não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Edição de Equipe.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(TeamEdition $teamEdition)
    {
        try {
            Gate::authorize('delete', $teamEdition);
            $this->teamEditionServices->destroy($teamEdition);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Edição de Equipe não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao deletar Edição Equipe.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
