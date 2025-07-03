<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'nama' => 'BERAS PANDAN WANGI',
                'harga'  => 19000,
                'satuan' => 'kg',
                'kategori_id' => 1,
                'jumlah' => 20,
                'foto' => 'beras_pandanwangi.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'BERAS ROJO LELE',
                'harga'  => 15000,
                'jumlah' => 25,
                'satuan' => 'kg',
                'kategori_id' => 1,
                'foto' => 'beras_rojolele.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'BERAS MENTIK WANGI',
                'harga'  => 14000,
                'satuan' => 'kg',
                'kategori_id' => 1,
                'jumlah' => 20,
                'foto' => 'beras_mentikwangi.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'BERAS IR64',
                'harga'  => 16000,
                'jumlah' => 23,
                'satuan' => 'kg',
                'kategori_id' => 1,
                'foto' => 'beras_ir64.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MINYAK HEMART',
                'harga'  => 19000,
                'satuan' => 'liter',
                'kategori_id' => 2,
                'jumlah' => 30,
                'foto' => 'minyakgoreng_hemart.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MINYAK BIMOLI',
                'harga'  => 23000,
                'jumlah' => 35,
                'satuan' => 'liter',
                'kategori_id' => 2,
                'foto' => 'minyakgoreng_bimoli.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MINYAK RIZKI',
                'harga'  => 18000,
                'satuan' => 'liter',
                'kategori_id' => 2,
                'jumlah' => 32,
                'foto' => 'minyakgoreng_rizki.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MINYAK FORTUNE',
                'harga'  => 21000,
                'jumlah' => 28,
                'satuan' => 'liter',
                'kategori_id' => 2,
                'foto' => 'minyakgoreng_fortune.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'GULA GULAKU',
                'harga'  => 26000,
                'satuan' => 'kg',
                'kategori_id' => 3,
                'jumlah' => 17,
                'foto' => 'gulapasir_gulaku.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'GULA ROSEBRAND',
                'harga'  => 22000,
                'jumlah' => 19,
                'satuan' => 'kg',
                'kategori_id' => 3,
                'foto' => 'gulapasir_rosebrand.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'GULA GUAVIT',
                'harga'  => 20000,
                'satuan' => 'kg',
                'kategori_id' => 3,
                'jumlah' => 14,
                'foto' => 'gulapasir_guavit.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MIE KUAH ABC',
                'harga'  => 125000,
                'jumlah' => 10,
                'satuan' => 'kardus',
                'kategori_id' => 4,
                'foto' => 'mieinstan_abc.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MIE KUAH SUPERMI',
                'harga'  => 120000,
                'jumlah' => 8,
                'satuan' => 'kardus',
                'kategori_id' => 4,
                'foto' => 'mieinstan_supermie.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MIE KUAH INDOMIE',
                'harga'  => 120000,
                'jumlah' => 13,
                'satuan' => 'kardus',
                'kategori_id' => 4,
                'foto' => 'mieinstan_indomie.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MIE KUAH SEDAAP',
                'harga'  => 123000,
                'jumlah' => 12,
                'satuan' => 'kardus',
                'kategori_id' => 4,
                'foto' => 'mieinstan_sedap.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('product')->insert($item);
        }
    }
}