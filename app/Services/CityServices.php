<?php


    namespace App\Services;

    use App\Http\Requests\CityStoreRequest;
    use App\Http\Requests\CityUpdateRequest;
    use App\Models\City;

    class CityServices
    {
        public function list()
        {
            $citys = City::paginate();
            return $citys;
        }

        public function store(CityStoreRequest $request){
            $city = City::create($request->validated());
            return $city;
        }

        public function update(CityUpdateRequest $request, City $city){
            $city->update($request->validated());
            
            return $city;
        }

        public function destroy(City $city){
            $city->delete();
        }
    }