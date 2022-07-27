<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_role extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_role' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
        ]);
        $this->dbforge->add_key('id_role', true);
        $this->dbforge->create_table('role', true);

        $data = [
            ['role' => 'Dewan Admin'],
            ['role' => 'Super Admin'],
        ];

        $this->db->insert_batch('role', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('role');
    }
}
