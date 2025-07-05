<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiskonTable extends Migration
{
    public function up()
{
    if (!$this->db->tableExists('user')) {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'email'      => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => '255'],
            'role'       => ['type' => 'VARCHAR', 'constraint' => '50'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }
}
    public function down()
    {
        $this->forge->dropTable('diskon');
    }
}
