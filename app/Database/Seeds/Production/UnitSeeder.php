<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            ['unit_name'     => 'buah'],
            ['unit_name'     => 'orang'],
            ['unit_name'     => 'jam'],
            ['unit_name'     => 'hari'],
            ['unit_name'     => 'bulan'],
            ['unit_name'     => 'tahun'],
            ['unit_name'     => 'kali'],
            ['unit_name'     => 'RIM'],
            ['unit_name'     => 'semester'],
            ['unit_name'     => 'ujian'],
            ['unit_name'     => 'kelas'],
            ['unit_name'     => 'buku'],
        ];
        foreach ($datas as $key => $value) {
            $this->db->table('unit')->insert($value);
        }
    }

}
