<?php


    namespace App\Services;

    use App\Http\Requests\PositionStoreRequest;
    use App\Http\Requests\PositionUpdateRequest;
    use App\Models\Position;

    class PositionServices
    {
        public function list()
        {
            $positions = Position::paginate();
            return $positions;
        }

        public function store(PositionStoreRequest $request){
            $position = Position::create($request->validated());
            return $position;
        }

        public function update(PositionUpdateRequest $request, Position $position){
            $position->update($request->validated());
            
            return $position;
        }

        public function destroy(Position $position){
            $position->delete();
        }
    }