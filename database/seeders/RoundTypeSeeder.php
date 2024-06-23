<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoundTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('round_types')->insert([
            ['name' => 'Fase de Grupos'],
            ['name' => 'Oitavas de Final'],
            ['name' => 'Quartas de Final'],
            ['name' => 'Semifinais'],
            ['name' => 'Final'],
            ['name' => 'Terceiro Lugar'],
        ]);
    }
}
