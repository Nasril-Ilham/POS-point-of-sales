<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class stokseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
        'stok_id' => 200,
        'supplier_id' => 001,
        'kategori_id' => 10,
        'user_id' => 1,
        'stok_tanggal' => '2024-01-01',
        'stok_jumlah' => 12,
    ],
    [
        'stok_id' => 201,
        'supplier_id' => 002,
        'kategori_id' => 10,
        'user_id' => 2,
        'stok_tanggal' => '2024-01-02',
        'stok_jumlah' => 15,
    ],
    [
        'stok_id' => 202,
        'supplier_id' => 003,
        'kategori_id' => 10,
        'user_id' => 3,
        'stok_tanggal' => '2024-01-03',
        'stok_jumlah' => 10,
    ],
    [
        'stok_id' => 203,
        'supplier_id' => 001,
        'kategori_id' => 20,
        'user_id' => 1,
        'stok_tanggal' => '2024-01-04',
        'stok_jumlah' => 8,
    ],
    [
        'stok_id' => 204,
        'supplier_id' => 002,
        'kategori_id' => 20,
        'user_id' => 2,
        'stok_tanggal' => '2024-01-05',
        'stok_jumlah' => 20,
    ],
    [
        'stok_id' => 205,
        'supplier_id' => 003,
        'kategori_id' => 20,
        'user_id' => 3,
        'stok_tanggal' => '2024-01-06',
        'stok_jumlah' => 17,
    ],
    [
        'stok_id' => 206,
        'supplier_id' => 001,
        'kategori_id' => 30,
        'user_id' => 1,
        'stok_tanggal' => '2024-01-07',
        'stok_jumlah' => 9,
    ],
    [
        'stok_id' => 207,
        'supplier_id' => 002,
        'kategori_id' => 30,
        'user_id' => 2,
        'stok_tanggal' => '2024-01-08',
        'stok_jumlah' => 14,
    ],
    [
        'stok_id' => 208,
        'supplier_id' => 003,
        'kategori_id' => 30,
        'user_id' => 3,
        'stok_tanggal' => '2024-01-09',
        'stok_jumlah' => 11,
    ],
    [
        'stok_id' => 209,
        'supplier_id' => 001,
        'kategori_id' => 40,
        'user_id' => 1,
        'stok_tanggal' => '2024-01-10',
        'stok_jumlah' => 13,
    ],
    [
        'stok_id' => 210,
        'supplier_id' => 002,
        'kategori_id' => 40,
        'user_id' => 2,
        'stok_tanggal' => '2024-01-11',
        'stok_jumlah' => 16,
    ],
    [
        'stok_id' => 211,
        'supplier_id' => 003,
        'kategori_id' => 40,
        'user_id' => 3,
        'stok_tanggal' => '2024-01-12',
        'stok_jumlah' => 7,
    ],
    [
        'stok_id' => 212,
        'supplier_id' => 001,
        'kategori_id' => 50,
        'user_id' => 1,
        'stok_tanggal' => '2024-01-13',
        'stok_jumlah' => 18,
    ],
    [
        'stok_id' => 213,
        'supplier_id' => 002,
        'kategori_id' => 50,
        'user_id' => 2,
        'stok_tanggal' => '2024-01-14',
        'stok_jumlah' => 22,
    ],
    [
        'stok_id' => 214,
        'supplier_id' => 003,
        'kategori_id' => 50,
        'user_id' => 3,
        'stok_tanggal' => '2024-01-15',
        'stok_jumlah' => 19,
    ],

        ];
        DB::table('t_stok')->insert($data);
    }
}
