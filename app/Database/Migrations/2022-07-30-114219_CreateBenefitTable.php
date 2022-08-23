<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBenefitTable extends Migration
{
    public function up()
    {
        // mendefinisikan properti
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'benefit' => [
                'type'       => 'TEXT',
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'unit_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'unit_price' => [
                'type'           => 'BIGINT',
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        // mendefinisikan foreign key
        $this->forge->addForeignKey('category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unit_id', 'unit', 'id');

        //mendefinisikan nama tabel
        $this->forge->createTable('benefit');
    }

    public function down()
    {
        // drop table if exist role
        $this->forge->dropTable('benefit', true);
    }
}
