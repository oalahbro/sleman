<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_dinas extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_diter' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama_dinas' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 2,
                'unsigned'   => true,
            ],
        ]);
        $this->dbforge->add_key('id_diter', true);
        $this->dbforge->create_table('dinas', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('dinas');
    }
}
