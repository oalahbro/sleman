<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_saran extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_saran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'email_saran' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'saran' => [
                'type' => 'TEXT',
            ],
            'foto_publik' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
        ]);
        $this->dbforge->add_key('id_saran', true);
        $this->dbforge->create_table('saran', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('saran');
    }
}
