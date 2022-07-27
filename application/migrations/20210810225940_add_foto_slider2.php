<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_foto_slider2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_fotoslider' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'foto_slider' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi_slider' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_slider' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
            ],
            'link_slider' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->dbforge->add_key('id_fotoslider', true);
        $this->dbforge->create_table('foto_slider_kedua', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('foto_slider_kedua');
    }
}
