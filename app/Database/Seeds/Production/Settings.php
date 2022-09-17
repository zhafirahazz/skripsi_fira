<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class Settings extends Seeder
{
    public function run()
    {
        $datas = [
            ['key'     => 'bcr.r', 'value'  => '5'],
            ['key'     => 'npv.r', 'value'  => '5'],
            ['key'     => 'irr.rr', 'value'  => '5'],
            ['key'     => 'pp.pa', 'value'  => '5'],
        ];
        foreach ($datas as $key => $value) {
            $this->db->table('pengaturan')->insert($value);
        }
    }
}
