<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'level_id' => '1',
                'user_nama' => 'Admin',
                'nama' => 'Admiministrator',
                'password' => Hash::make('admin123'),
            ],
            [
                'user_id' => 2,
                'level_id' => '2',
                'user_nama' => 'manager',
                'nama' => 'Manager',
                'password' => Hash::make('manager123'),
            ],
            [
                'user_id' => 3,
                'level_id' => 'LVL003',
                'user_nama' => 'staff',
                'nama' => 'Kasir',
                'password' => Hash::make('kasir123'),
            ]
        ];
        
        DB::table('m_user')->insert($data);
    }
}
