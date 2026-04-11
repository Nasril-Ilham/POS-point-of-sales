<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class barangseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            
    [
        'barang_id' => 1,
        'kategori_id' => 10,
        'barang_kode' => 'FD001',
        'barang_nama' => 'Nasi Goreng Instan',
        'harga_beli' => 5000,
        'harga_jual' => 8000
    ],
    [
        'barang_id' => 2,
        'kategori_id' => 10,
        'barang_kode' => 'FD002',
        'barang_nama' => 'Mie Instan',
        'harga_beli' => 3000,
        'harga_jual' => 5000
    ],
    [
        'barang_id' => 3,
        'kategori_id' => 10,
        'barang_kode' => 'FD003',
        'barang_nama' => 'Susu UHT',
        'harga_beli' => 6000,
        'harga_jual' => 9000
    ],
    [
        'barang_id' => 4,
        'kategori_id' => 20,
        'barang_kode' => 'PK001',
        'barang_nama' => 'Kaos Polos',
        'harga_beli' => 25000,
        'harga_jual' => 40000
    ],
    [
        'barang_id' => 5,
        'kategori_id' => 20,
        'barang_kode' => 'PK002',
        'barang_nama' => 'Celana Jeans',
        'harga_beli' => 80000,
        'harga_jual' => 120000
    ],
    [
        'barang_id' => 6,
        'kategori_id' => 20,
        'barang_kode' => 'PK003',
        'barang_nama' => 'Jaket Hoodie',
        'harga_beli' => 90000,
        'harga_jual' => 140000
    ],
    [
        'barang_id' => 7,
        'kategori_id' => 30,
        'barang_kode' => 'AK001',
        'barang_nama' => 'Jam Tangan',
        'harga_beli' => 50000,
        'harga_jual' => 85000
    ],
    [
        'barang_id' => 8,
        'kategori_id' => 30,
        'barang_kode' => 'AK002',
        'barang_nama' => 'Topi',
        'harga_beli' => 20000,
        'harga_jual' => 35000
    ],
    [
        'barang_id' => 9,
        'kategori_id' => 30,
        'barang_kode' => 'AK003',
        'barang_nama' => 'Kacamata',
        'harga_beli' => 40000,
        'harga_jual' => 70000
    ],
    [
        'barang_id' => 10,
        'kategori_id' => 40,
        'barang_kode' => 'BY001',
        'barang_nama' => 'Botol Susu Bayi',
        'harga_beli' => 15000,
        'harga_jual' => 25000
    ],
    [
        'barang_id' => 11,
        'kategori_id' => 40,
        'barang_kode' => 'BY002',
        'barang_nama' => 'Popok Bayi',
        'harga_beli' => 30000,
        'harga_jual' => 50000
    ],
    [
        'barang_id' => 12,
        'kategori_id' => 40,
        'barang_kode' => 'BY003',
        'barang_nama' => 'Bedak Bayi',
        'harga_beli' => 10000,
        'harga_jual' => 18000
    ],
    [
        'barang_id' => 13,
        'kategori_id' => 50,
        'barang_kode' => 'RT001',
        'barang_nama' => 'Sapu Lantai',
        'harga_beli' => 20000,
        'harga_jual' => 35000
    ],
    [
        'barang_id' => 14,
        'kategori_id' => 50,
        'barang_kode' => 'RT002',
        'barang_nama' => 'Ember',
        'harga_beli' => 15000,
        'harga_jual' => 25000
    ],
    [
        'barang_id' => 15,
        'kategori_id' => 50,
        'barang_kode' => 'RT003',
        'barang_nama' => 'Pel Lantai',
        'harga_beli' => 25000,
        'harga_jual' => 40000
    ],


        ];

        DB::table('m_barang')->insert($data);
    }
}
