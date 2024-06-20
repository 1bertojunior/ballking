<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = State::where('name', 'Piauí')->first();

        
        if ($state) {
            $stateId = $state->id;

            $cities = [
                ['name' => 'Teresina', 'abb' => 'THE', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Parnaíba', 'abb' => 'PHB', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Picos', 'abb' => 'PIC', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Belém do Piauí', 'abb' => 'BPI', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
            ];

            DB::table('cities')->insert($cities);
        } else {
            exit('Erro ao buscar estado Piauí');
        }
    }
}
