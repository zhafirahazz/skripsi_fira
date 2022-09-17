<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konfirmasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'valid_until' => [
                'type'       => 'BIGINT',
            ],
            'job_type' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        // mendefinisikan foreign key
        $this->forge->addForeignKey('user_id', 'user', 'id');

        //mendefinisikan nama tabel
        $this->forge->createTable('konfirmasi');
    }

    public function down()
    {
        $this->forge->dropTable('konfirmasi', true);
    }
}
