<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchupStoreRequest;
use App\Http\Requests\MatchupUpdateRequest;
use App\Models\Matchup;
use App\Services\MatchupServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MatchupController extends Controller
{
    public function __construct(protected MatchupServices $matchupServices)
    {}

    public function index()
    {
        try {
            Gate::authorize('viewAny', Matchup::class);
            $matchups = $this->matchupServices->list();
            return response()->json($matchups, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Confrontos.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(MatchupStoreRequest $request)
    {
        try {
            Gate::authorize('create', Matchup::class);
            $matchup = $this->matchupServices->store($request);

            return response()->json($matchup, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Confronto.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Matchup $matchup)
    {
        try {
            Gate::authorize('view', $matchup);
            return response()->json($matchup, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Confronto não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Confronto.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(MatchupUpdateRequest $request, Matchup $matchup)
    {
        try {
            Gate::authorize('update', $matchup);
            $matchup = $this->matchupServices->update($request, $matchup);

            return response()->json($matchup, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Confronto não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Confronto.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Matchup $matchup)
    {
        try {
            Gate::authorize('delete', $matchup);
            $this->matchupServices->destroy($matchup);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Confronto não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Confronto.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
