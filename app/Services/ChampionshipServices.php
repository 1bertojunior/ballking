<?php


    namespace App\Services;

    use App\Http\Requests\ChampionshipStoreRequest;
    use App\Http\Requests\ChampionshipUpdateRequest;
    use App\Models\Championship;

    class ChampionshipServices
    {
        public function list()
        {
            $championships = Championship::paginate();
            return $championships;
        }

        public function store(ChampionshipStoreRequest $request){
            $championship = Championship::create($request->validated());
            return $championship;
        }

        public function update(ChampionshipUpdateRequest $request, Championship $championship){
            $championship->update($request->validated());
            
            return $championship;
        }

        public function destroy(Championship $championship){
            $championship->delete();
        }
    }