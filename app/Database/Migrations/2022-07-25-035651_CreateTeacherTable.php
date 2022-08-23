<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        //mendefinisikan nama tabel
        $this->forge->createTable('teacher');
    }

    public function down()
    {
        // drop table if exist role
        $this->forge->dropTable('teacher', true);
    }

}
