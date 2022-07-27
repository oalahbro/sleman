<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_data_sekolah extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_sekolah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'alamat_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 13,
            ],
            'kategori_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->dbforge->add_key('id_sekolah', true);
        $this->dbforge->create_table('data_sekolah', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('data_sekolah');
    }
}
