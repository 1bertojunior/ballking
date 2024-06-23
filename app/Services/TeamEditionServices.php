<?php


    namespace App\Services;

    use App\Http\Requests\TeamEditionStoreRequest;
    use App\Http\Requests\TeamEditionUpdateRequest;
    use App\Models\TeamEdition;

    class TeamEditionServices
    {
        public function list()
        {
            $teamEditions = TeamEdition::paginate();
            return $teamEditions;
        }

        public function store(TeamEditionStoreRequest $request){
            $teamEdition = TeamEdition::create($request->validated());
            return $teamEdition;
        }

        public function update(TeamEditionUpdateRequest $request, TeamEdition $teamEdition){
            $teamEdition->update($request->validated());
            
            return $teamEdition;
        }

        public function destroy(TeamEdition $teamEdition){
            $teamEdition->delete();
        }
    }