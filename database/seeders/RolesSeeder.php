<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin','created_at' => now(), 'updated_at' => now()],
            ['name' => 'Usuário','created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('roles')->insert($roles);
    }
}
