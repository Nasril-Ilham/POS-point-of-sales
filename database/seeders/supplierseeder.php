<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class supplierseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => '001',
                'supplier_kode' => 'kk1',
                'supplier_nama' => 'nasruliman',
                'supplier_alamat' => 'bandung',
            ],
            [
                'supplier_id' => '002',
                'supplier_kode' => 'kk2',
                'supplier_nama' => 'nahlumin',
                'supplier_alamat' => 'solo',
            ],
            [
                'supplier_id' => '003',
                'supplier_kode' => 'kk3',
                'supplier_nama' => 'nindalan',
                'supplier_alamat' => 'surabaya',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
