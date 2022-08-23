<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
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
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'email' => [
                'type'       => 'TEXT',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'approved' => [
                'type'       => 'BOOLEAN'
            ],
        ]);

        // mendefinisikan key
        $this->forge->addKey('id', true);

        // mendefinisikan foreign key
        $this->forge->addForeignKey('role_id', 'role', 'id');

        //mendefinisikan nama tabel
        $this->forge->createTable('user');
    }

    public function down()
    {
        // drop table if exist user
        $this->forge->dropTable('user', true);
    }
}
