<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert(
            [
                'user_id' => 1,
                // 'nama' => 'Example Name',
                'nip' => '110748'
            ]
        );
        DB::table('pegawais')->insert(
            [
                'user_id' => 2,
                // 'nama' => 'Pegawai Name',
                'nip' => '110749'
            ]
        );
    }
}
