<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['name' => 'Atacante', 'abb' => 'ATA'],
            ['name' => 'Meio-campo', 'abb' => 'MEI'],
            ['name' => 'Zagueiro', 'abb' => 'ZAG'],
            ['name' => 'Goleiro', 'abb' => 'GOL'],
            ['name' => 'Reserva', 'abb' => 'RES'],
        ]);
    }
}
