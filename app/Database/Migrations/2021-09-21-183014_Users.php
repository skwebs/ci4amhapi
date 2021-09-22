<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //
        // XXXXXXXXXXXXXXXXXXXXXXXXXXXX ROLES XXXXXXXXXXXXXXXXXXXXXXXX ROLES XXXXXXXXXXXXXXXXXXXXX ROLES XXXXXXXXXXXXXXXXXXXX ROLES XXXXXXXXXXXXX
        $this->forge->addField([
            'id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'  => ['type' => 'varchar', 'constraint' => 20],
            'email' => ['type' => 'varchar', 'constraint' => 35],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addUniqueKey('role_name');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('users');
    }
}
