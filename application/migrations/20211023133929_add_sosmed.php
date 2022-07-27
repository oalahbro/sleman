<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_sosmed extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_sosmed' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama_sos' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->dbforge->add_key('id_sosmed', true);
        $this->dbforge->create_table('sosmed', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('sosmed');
    }
}
