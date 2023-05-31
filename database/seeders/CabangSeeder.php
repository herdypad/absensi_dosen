<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabangs')->insert(
            [
                'id' => 1,
                'cabang' => 'Pontianak',
                'alamat' => 'Jl. Sumatera'
            ]
        );
        DB::table('cabangs')->insert(
            [
                'id' => 2,
                'cabang' => 'Kubu Raya',
                'alamat' => 'Jl. Ahmad Yani 2'
            ],
        );
    }
}
