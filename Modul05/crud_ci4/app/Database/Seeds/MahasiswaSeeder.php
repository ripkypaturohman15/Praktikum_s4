<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
            ],
            [
                'nama' => 'Ani Wijaya',
                'email' => 'ani@example.com',
            ],
        ];

        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
