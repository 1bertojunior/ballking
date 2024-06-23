<?php


    namespace App\Services;

    use App\Http\Requests\ChampionshipEditionStoreRequest;
    use App\Http\Requests\ChampionshipEditionUpdateRequest;
use App\Models\ChampionshipEdition;

    class ChampionshipEditionServices
    {
        public function list()
        {
            $championship_editions = ChampionshipEdition::paginate();
            return $championship_editions;
        }

        public function store(ChampionshipEditionStoreRequest $request){
            $championship_edition = ChampionshipEdition::create($request->validated());
            return $championship_edition;
        }

        public function update(ChampionshipEditionUpdateRequest $request, ChampionshipEdition $championship_edition){
            $championship_edition->update($request->validated());
            
            return $championship_edition;
        }

        public function destroy(ChampionshipEdition $championship_edition){
            $championship_edition->delete();
        }
    }