<?php


    namespace App\Services;

    use App\Http\Requests\PlayerStoreRequest;
    use App\Http\Requests\PlayerUpdateRequest;
    use App\Models\Player;

    class PlayerServices
    {
        public function list()
        {
            $players = Player::paginate();
            return $players;
        }

        public function store(PlayerStoreRequest $request){
            $player = Player::create($request->validated());
            return $player;
        }

        public function update(PlayerUpdateRequest $request, Player $player){
            $player->update($request->validated());
            
            return $player;
        }

        public function destroy(Player $player){
            $player->delete();
        }
    }