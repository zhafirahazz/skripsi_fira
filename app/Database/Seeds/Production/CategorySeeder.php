<?php

namespace App\Database\Seeds\Production;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $datas = [
            ['category_name'     => 'procurement',
            'category_display'  => 'Procurement Cost'],
            ['category_name'     => 'startup',
            'category_display'  => 'Start Up Cost'],
            ['category_name'     => 'project_related',
            'category_display'  => 'Project Related Cost'],
            ['category_name'     => 'ongoing',
            'category_display'  => 'Ongoing Cost'],
            ['category_name'     => 'tangible',
            'category_display'  => 'Tangible Benefit'],
            ['category_name'     => 'intangible',
            'category_display'  => 'Intangible Benefit'],
        ];
        foreach ($datas as $key => $value) {
            $this->db->table('category')->insert($value);
        }
    }

}
