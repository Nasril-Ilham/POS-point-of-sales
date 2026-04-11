<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 10,
                'kategori_kode' => 'SS1',
                'kategori_nama' => 'food'
            ],
            [
                'kategori_id' => 20,
                'kategori_kode' => 'SS2',
                'kategori_nama' => 'pakaian'
            ],
            [
                'kategori_id' => 30,
                'kategori_kode' => 'SS3',
                'kategori_nama' => 'aksesoris'
            ],
            [
                'kategori_id' => 40,
                'kategori_kode' => 'SS4',
                'kategori_nama' => 'peralatan bayi'
            ],
            [
                'kategori_id' => 50,
                'kategori_kode' => 'SS5',
                'kategori_nama' => 'peralatan rumah'
            ],

        ];

        
        DB::table('m_kategori')->insert($data);
    }
}
