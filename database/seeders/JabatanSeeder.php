<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert(
            [
                'id' => 1,
                'jabatan' => 'CEO'
            ]
        );
        DB::table('jabatans')->insert(
            [
                'id' => 2,
                'jabatan' => 'Teknisi'
            ],
        );
    }
}
