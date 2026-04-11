<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class penjualandetailseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
    ['detail_id'=>400,'penjualan_id'=>300,'barang_id'=>1,'harga'=>8000,'jumlah'=>3],
    ['detail_id'=>401,'penjualan_id'=>300,'barang_id'=>2,'harga'=>5000,'jumlah'=>4],
    ['detail_id'=>402,'penjualan_id'=>300,'barang_id'=>3,'harga'=>9000,'jumlah'=>5],

    ['detail_id'=>403,'penjualan_id'=>301,'barang_id'=>4,'harga'=>40000,'jumlah'=>3],
    ['detail_id'=>404,'penjualan_id'=>301,'barang_id'=>5,'harga'=>120000,'jumlah'=>4],
    ['detail_id'=>405,'penjualan_id'=>301,'barang_id'=>6,'harga'=>140000,'jumlah'=>3],

    ['detail_id'=>406,'penjualan_id'=>302,'barang_id'=>7,'harga'=>85000,'jumlah'=>3],
    ['detail_id'=>407,'penjualan_id'=>302,'barang_id'=>8,'harga'=>35000,'jumlah'=>5],
    ['detail_id'=>408,'penjualan_id'=>302,'barang_id'=>9,'harga'=>70000,'jumlah'=>4],

    ['detail_id'=>409,'penjualan_id'=>303,'barang_id'=>10,'harga'=>25000,'jumlah'=>3],
    ['detail_id'=>410,'penjualan_id'=>303,'barang_id'=>11,'harga'=>50000,'jumlah'=>4],
    ['detail_id'=>411,'penjualan_id'=>303,'barang_id'=>12,'harga'=>18000,'jumlah'=>6],

    ['detail_id'=>412,'penjualan_id'=>304,'barang_id'=>13,'harga'=>35000,'jumlah'=>3],
    ['detail_id'=>413,'penjualan_id'=>304,'barang_id'=>14,'harga'=>25000,'jumlah'=>4],
    ['detail_id'=>414,'penjualan_id'=>304,'barang_id'=>15,'harga'=>40000,'jumlah'=>5],

    ['detail_id'=>415,'penjualan_id'=>305,'barang_id'=>1,'harga'=>8000,'jumlah'=>6],
    ['detail_id'=>416,'penjualan_id'=>305,'barang_id'=>5,'harga'=>120000,'jumlah'=>3],
    ['detail_id'=>417,'penjualan_id'=>305,'barang_id'=>9,'harga'=>70000,'jumlah'=>4],

    ['detail_id'=>418,'penjualan_id'=>306,'barang_id'=>2,'harga'=>5000,'jumlah'=>5],
    ['detail_id'=>419,'penjualan_id'=>306,'barang_id'=>6,'harga'=>140000,'jumlah'=>3],
    ['detail_id'=>420,'penjualan_id'=>306,'barang_id'=>10,'harga'=>25000,'jumlah'=>4],

    ['detail_id'=>421,'penjualan_id'=>307,'barang_id'=>3,'harga'=>9000,'jumlah'=>3],
    ['detail_id'=>422,'penjualan_id'=>307,'barang_id'=>7,'harga'=>85000,'jumlah'=>4],
    ['detail_id'=>423,'penjualan_id'=>307,'barang_id'=>11,'harga'=>50000,'jumlah'=>5],

    ['detail_id'=>424,'penjualan_id'=>308,'barang_id'=>4,'harga'=>40000,'jumlah'=>3],
    ['detail_id'=>425,'penjualan_id'=>308,'barang_id'=>8,'harga'=>35000,'jumlah'=>4],
    ['detail_id'=>426,'penjualan_id'=>308,'barang_id'=>12,'harga'=>18000,'jumlah'=>5],

    ['detail_id'=>427,'penjualan_id'=>309,'barang_id'=>13,'harga'=>35000,'jumlah'=>3],
    ['detail_id'=>428,'penjualan_id'=>309,'barang_id'=>14,'harga'=>25000,'jumlah'=>4],
    ['detail_id'=>429,'penjualan_id'=>309,'barang_id'=>15,'harga'=>40000,'jumlah'=>6],
];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
