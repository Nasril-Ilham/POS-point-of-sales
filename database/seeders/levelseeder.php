<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class levelseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => 1, 'level_kode' => 'LVL001', 'level_nama' => 'Admin'],
            ['level_id' => 2, 'level_kode' => 'LVL002', 'level_nama' => 'manager'],
            ['level_id' => 3, 'level_kode' => 'LVL003', 'level_nama' => 'kasir'],
        ];

        // Insert data into the m_level table
        DB::table('m_level')->insert($data);
    }
}
