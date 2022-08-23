<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            ['class_name'     => 'kelas_x',
            'class_display'  => 'Kelas X'],
            ['class_name'     => 'kelas_xi',
            'class_display'  => 'Kelas XI'],
            ['class_name'     => 'kelas_xii',
            'class_display'  => 'Kelas XII'],
        ];
        foreach ($datas as $key => $value) {
            $this->db->table('class')->insert($value);
        }
    }

}
