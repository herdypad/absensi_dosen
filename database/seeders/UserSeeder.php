<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'nama' => 'Admin',
                'email' => 'Admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'Admin',
            ]
        );
        DB::table('users')->insert(
            [
                'nama' => 'Abdul',
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('pegawai'),
                'role' => 'Pegawai',
            ]
        );
    }
}
