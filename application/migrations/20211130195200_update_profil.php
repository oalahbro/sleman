<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_profil extends CI_Migration
{
    public function up()
    {
        $this->dbforge->modify_column('user', [
            'foto_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'default'    => null,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->modify_column('user', [
            'foto_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
    }
}
