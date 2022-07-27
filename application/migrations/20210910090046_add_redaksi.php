<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_redaksi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_redaksi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'id_struktur_redaksi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'nama_pengurus' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'masa_jabatan' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key('id_redaksi', true);
        $this->dbforge->create_table('redaksi', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('redaksi');
    }
}
