<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder untuk Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'alamat' => 'Jl. Contoh Admin', // alamat opsional
            'tinggi_badan' => 175, // opsional
            'berat_badan' => 70, // opsional
            'tanggal_lahir' => '1980-01-01', // opsional
            'jenis_kelamin' => 'Pria', // atau 'Wanita'
            'no_hp' => '08123456789', // opsional
            'foto' => null, // opsional
            'role' => 1, // 1 untuk Admin
            'email' => 'admin@simondm.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seeder untuk User
        DB::table('users')->insert([
            'name' => 'User',
            'alamat' => 'Jl. Contoh User', // opsional
            'tinggi_badan' => 160, // opsional
            'berat_badan' => 55, // opsional
            'tanggal_lahir' => '1995-01-01', // opsional
            'jenis_kelamin' => 'Wanita', // atau 'Pria'
            'no_hp' => '08123456788', // opsional
            'foto' => null, // opsional
            'role' => 0, // 0 untuk User
            'email' => 'user@simondm.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'User2',
            'alamat' => 'Jl. Contoh User', // opsional
            'tinggi_badan' => 170, // opsional
            'berat_badan' => 65, // opsional
            'tanggal_lahir' => '2001-01-01', // opsional
            'jenis_kelamin' => 'Pria', // atau 'Pria'
            'no_hp' => '08123456789', // opsional
            'foto' => null, // opsional
            'role' => 0, // 0 untuk User
            'email' => 'user2@simondm.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
