<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Zhafirah Az-Zahra',
            'role_id'  => '1',
            'email'    => 'zhafirahaz23@gmail.com',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'approved' => TRUE
        ];
        $this->db->table('user')->insert($data);
    }

}
