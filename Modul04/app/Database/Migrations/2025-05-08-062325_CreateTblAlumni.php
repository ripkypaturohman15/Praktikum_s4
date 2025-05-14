<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateTblAlumni extends Migration
{
public function up()
{
$this->forge->addField([
'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],'nim' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
'nama' => ['type' => 'VARCHAR', 'constraint' => 255],
'jurusan' => ['type' => 'VARCHAR', 'constraint' => 100],
'created_at' => ['type' => 'DATETIME', 'null' => true],
'updated_at' => ['type' => 'DATETIME', 'null' => true]
]);
$this->forge->addPrimaryKey('id');
$this->forge->createTable('tblalumni');
}
public function down()
{
$this->forge->dropTable('tblalumni');
}
}