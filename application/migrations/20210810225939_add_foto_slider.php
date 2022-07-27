<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_foto_slider extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_foto' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->dbforge->add_key('id_foto', true);
        $this->dbforge->create_table('foto_slider', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('foto_slider');
    }
}
