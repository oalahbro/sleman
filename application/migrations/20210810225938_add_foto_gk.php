<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_foto_gk extends CI_Migration
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
                'constraint' => 250,
            ],
            'judul_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'tgl_fotogk' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key('id_foto', true);
        $this->dbforge->create_table('foto_gk', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('foto_gk');
    }
}
