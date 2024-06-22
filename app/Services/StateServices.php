<?php


    namespace App\Services;

    use App\Http\Requests\StateStoreRequest;
    use App\Http\Requests\StateUpdateRequest;
    use App\Models\State;

    class StateServices
    {
        public function list()
        {
            $states = State::paginate();
            return $states;
        }

        public function store(StateStoreRequest $request){
            $state = State::create($request->validated());
            return $state;
        }

        public function update(StateUpdateRequest $request, State $state){
            $state->update($request->validated());
            
            return $state;
        }

        public function destroy(State $state){
            $state->delete();
        }
    }