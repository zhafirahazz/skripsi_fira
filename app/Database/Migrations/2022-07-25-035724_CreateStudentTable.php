<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentTable extends Migration
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
            'class_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        // mendefinisikan foreign key
        $this->forge->addForeignKey('class_id', 'class', 'id');

        //mendefinisikan nama tabel
        $this->forge->createTable('student');
    }

    public function down()
    {
        // drop table if exist role
        $this->forge->dropTable('student', true);
    }

}
