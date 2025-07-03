<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'kategori' => 'BERAS',
                'foto' => 'beras.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'MINYAK GORENG',
                'foto' => 'minyakgoreng.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'GULA PASIR',
                'foto' => 'gulapasir.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'MIE INSTAN',
                'foto' => 'mieinstan.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'KECAP',
                'foto' => 'kecap.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'SARDEN',
                'foto' => 'sarden.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'TEH',
                'foto' => 'teh.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'kategori' => 'SIRUP',
                'foto' => 'sirup.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('category')->insert($item);
        }
    }
}
