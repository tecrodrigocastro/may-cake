<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::created([
            'name' => 'Rodrigo Castro',
            'email' => 'redrodrigo.dev@gmail.com',
            'password' => bcrypt('Codeofsucess@1'),
            'phone' => '11999999999',
            'cpf' => '12345678901',
            'type' => 'admin',
        ]);
    }
}
