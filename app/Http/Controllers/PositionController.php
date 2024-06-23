<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionStoreRequest;
use App\Http\Requests\PositionUpdateRequest;
use App\Models\Position;
use App\Services\PositionServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PositionController extends Controller
{
    public function __construct(protected PositionServices $positionServices)
    {}
   
    public function index()
    {
        try {
            Gate::authorize('viewAny', Position::class);
            $positions = $this->positionServices->list();
            return response()->json($positions, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Posições.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PositionStoreRequest $request)
    {
        try {
            Gate::authorize('create', Position::class);
            $position = $this->positionServices->store($request);
            return response()->json($position, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar Posição.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Position $position)
    {
        try {
            Gate::authorize('view', $position);
            return response()->json($position, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Posição não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Posição.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PositionUpdateRequest $request, Position $position)
    {
        try {
            Gate::authorize('update', $position);
            $state = $this->positionServices->update($request, $position);
            return response()->json($state, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Posição não encontrada.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Posição.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Position $position)
    {
        try {
            Gate::authorize('delete', $position);
            $this->positionServices->destroy($position);
            
            return response()->json([
                'message' => 'Deletado com sucesso'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Posição não encontrado.',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar Posição.',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
