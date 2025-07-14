<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminRoleToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'admin'],
                'default'    => 'user',
                'after'      => 'password'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role');
    }
}
