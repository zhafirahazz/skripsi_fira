<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            ['role_name'     => 'admin',
            'role_display'  => 'Admin'],
            ['role_name'     => 'kepala_sekolah',
            'role_display'  => 'Kepala Sekolah'],
        ];
        foreach ($datas as $key => $value) {
            $this->db->table('role')->insert($value);
        }
    }

}
