<?php


    namespace App\Services;

    use App\Http\Requests\AddressStoreRequest;
    use App\Http\Requests\AddressUpdateRequest;
    use App\Models\Address;

    class AddressServices
    {
        public function list()
        {
            $addresses = Address::paginate();
            return $addresses;
        }

        public function store(AddressStoreRequest $request){
            $address = Address::create($request->validated());
            return $address;
        }

        public function update(AddressUpdateRequest $request, Address $address){
            $address->update($request->validated());
            
            return $address;
        }

        public function destroy(Address $address){
            $address->delete();
        }
    }