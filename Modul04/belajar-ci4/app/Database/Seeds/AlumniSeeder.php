<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class AlumniSeeder extends Seeder
{
public function run()
{
$data = [
[
'nim' => '017006001',
'nama' => 'Dede Irawan',
'jurusan' => 'Teknik Informatika',
'created_at' => '2025-04-01',
'updated_at' => '2025-04-01',
],
[
'nim' => '017006002',
'nama' => 'Dede Irawan',
'jurusan' => 'Teknik Informatika',
'created_at' => '2025-04-01',
'updated_at' => '2025-04-01',
],
];
$this->db->table('tblalumni')->insertBatch($data);
}
}