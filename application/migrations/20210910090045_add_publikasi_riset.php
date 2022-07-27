<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_publikasi_riset extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_publikasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama_pembuat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'tgl' => [
                'type' => 'TIMESTAMP',
            ],
            'tgl_update' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key('id_publikasi', true);
        $this->dbforge->create_table('publikasi_riset', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('publikasi_riset');
    }
}
