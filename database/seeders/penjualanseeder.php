<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class penjualanseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            
    [
        'penjualan_id' => 300,
        'user_id' => 1,
        'pembeli' => 'Andi',
        'penjualan_kode' => 'PJ001',
        'penjualan_tanggal' => '2024-03-01'
    ],
    [
        'penjualan_id' => 301,
        'user_id' => 2,
        'pembeli' => 'Budi',
        'penjualan_kode' => 'PJ002',
        'penjualan_tanggal' => '2024-03-02'
    ],
    [
        'penjualan_id' => 302,
        'user_id' => 3,
        'pembeli' => 'Citra',
        'penjualan_kode' => 'PJ003',
        'penjualan_tanggal' => '2024-03-03'
    ],
    [
        'penjualan_id' => 303,
        'user_id' => 1,
        'pembeli' => 'Dewi',
        'penjualan_kode' => 'PJ004',
        'penjualan_tanggal' => '2024-03-04'
    ],
    [
        'penjualan_id' => 304,
        'user_id' => 2,
        'pembeli' => 'Eko',
        'penjualan_kode' => 'PJ005',
        'penjualan_tanggal' => '2024-03-05'
    ],
    [
        'penjualan_id' => 305,
        'user_id' => 3,
        'pembeli' => 'Fajar',
        'penjualan_kode' => 'PJ006',
        'penjualan_tanggal' => '2024-03-06'
    ],
    [
        'penjualan_id' => 306,
        'user_id' => 1,
        'pembeli' => 'Gina',
        'penjualan_kode' => 'PJ007',
        'penjualan_tanggal' => '2024-03-07'
    ],
    [
        'penjualan_id' => 307,
        'user_id' => 2,
        'pembeli' => 'Hadi',
        'penjualan_kode' => 'PJ008',
        'penjualan_tanggal' => '2024-03-08'
    ],
    [
        'penjualan_id' => 308,
        'user_id' => 3,
        'pembeli' => 'Intan',
        'penjualan_kode' => 'PJ009',
        'penjualan_tanggal' => '2024-03-09'
    ],
    [
        'penjualan_id' => 309,
        'user_id' => 1,
        'pembeli' => 'Joko',
        'penjualan_kode' => 'PJ010',
        'penjualan_tanggal' => '2024-03-10'
    ],

        ];

        DB::table('t_penjualan')->insert($data);
    }
}
