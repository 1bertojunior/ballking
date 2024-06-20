<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
        
    public function run(): void
    {

        $adminRole = Roles::where('name', 'Admin')->first();
        
        if ($adminRole) {
            $adminId = $adminRole->id;

            $adminData = [
                'username' => 'admin',
                'email'=> 'admin@ballking.com',
                'password' => bcrypt('12345678!@'),
                'first_name' => 'Administrator',
                'last_name' => 'do Sistema',
                'role_id' => $adminId
            ];

            DB::table('users')->insert($adminData);

            $userRole = Roles::where('name', 'Usuário')->first();
        
            if ($userRole) {
                $userId = $userRole->id;
    
                $usersData = [
                    'username' => 'Test', 'email'=> 'test@ballking.com', 'password' => bcrypt('12345678!@'), 'first_name' => 'Test', 'last_name' => 'do Sistema', 'role_id' => $userId,
                ];
    
                DB::table('users')->insert($usersData);
            }else{
                exit('Erro ao criar Usuários');
            }

        }else{
            exit('Erro ao criar Adminitrador');
        }
        
    }
}
