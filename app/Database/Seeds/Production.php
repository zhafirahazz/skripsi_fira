<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Production extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\Production\CategorySeeder');
        $this->call('App\Database\Seeds\Production\ClassSeeder');
        $this->call('App\Database\Seeds\Production\RoleSeeder');
        $this->call('App\Database\Seeds\Production\UnitSeeder');
        $this->call('App\Database\Seeds\Production\UserSeeder');
    }
}
