<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'id_produk'   => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
        ],
        'qty'         => [
            'type'       => 'INT',
            'constraint' => 5,
        ],
        'created_at'  => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at'  => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('keranjang'); // <-- pastikan ini nama tabelnya
}


    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}