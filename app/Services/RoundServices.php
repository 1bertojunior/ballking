<?php


    namespace App\Services;

    use App\Http\Requests\RoundStoreRequest;
    use App\Http\Requests\RoundUpdateRequest;
    use App\Models\Round;

    class RoundServices
    {
        public function list()
        {
            $rounds = Round::paginate();
            return $rounds;
        }

        public function store(RoundStoreRequest $request){
            $round = Round::create($request->validated());
            return $round;
        }

        public function update(RoundUpdateRequest $request, Round $round){
            $round->update($request->validated());
            
            return $round;
        }

        public function destroy(Round $round){
            $round->delete();
        }
    }