<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::Create([
            'username' => 'miqdar',
            'nama_lengkap' => 'Muhammad Miqdar Salim',
            'password' => Hash::make('admin123'),
        ]);
        User::Create([
            'username' => 'fauzan',
            'nama_lengkap' => 'Fauzan Fadhilah',
            'password' => Hash::make('user123'),
        ]);
    }
}
