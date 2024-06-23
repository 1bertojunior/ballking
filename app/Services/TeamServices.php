<?php


    namespace App\Services;

    use App\Http\Requests\TeamStoreRequest;
    use App\Http\Requests\TeamUpdateRequest;
    use App\Models\Team;

    class TeamServices
    {
        public function list()
        {
            $teams = Team::paginate();
            return $teams;
        }

        public function store(TeamStoreRequest $request){
            $team = Team::create($request->validated());
            return $team;
        }

        public function update(TeamUpdateRequest $request, Team $team){
            $team->update($request->validated());
            
            return $team;
        }

        public function destroy(Team $team){
            $team->delete();
        }
    }