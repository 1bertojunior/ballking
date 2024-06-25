<?php


    namespace App\Services;

    use App\Http\Requests\MatchupStoreRequest;
    use App\Http\Requests\MatchupUpdateRequest;
    use App\Models\Matchup;

    class MatchupServices
    {
        public function list()
        {
            $matchups = Matchup::paginate();
            return $matchups;
        }

        public function store(MatchupStoreRequest $request){
            $matchup = Matchup::create($request->validated());
            return $matchup;
        }

        public function update(MatchupUpdateRequest $request, Matchup $matchup){
            $matchup->update($request->validated());
            
            return $matchup;
        }

        public function destroy(Matchup $matchup){
            $matchup->delete();
        }
    }