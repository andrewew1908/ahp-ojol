<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Login::create([
            'username' => 'admin',
            'password' => Hash::make('123'),
            'nama' => fake()->name(),
        ]);
    }
}
