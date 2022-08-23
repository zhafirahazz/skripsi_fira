<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        // mendefinisikan properti
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'category_display' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        //mendefinisikan nama tabel
        $this->forge->createTable('category');
    }

    public function down()
    {
        // drop table if exist role
        $this->forge->dropTable('category', true);
    }

}
