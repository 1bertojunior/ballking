<?php


    namespace App\Services;

    use App\Http\Requests\RoundTypeStoreRequest;
    use App\Http\Requests\RoundTypeUpdateRequest;
    use App\Models\RoundType;

    class RoundTypeServices
    {
        public function list()
        {
            $roundTypes = RoundType::paginate();
            return $roundTypes;
        }

        public function store(RoundTypeStoreRequest $request){
            $roundType = RoundType::create($request->validated());
            return $roundType;
        }

        public function update(RoundTypeUpdateRequest $request, RoundType $roundType){
            $roundType->update($request->validated());
            
            return $roundType;
        }

        public function destroy(RoundType $roundType){
            $roundType->delete();
        }
    }