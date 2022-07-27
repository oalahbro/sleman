<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_struktur extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_struktur' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'id_jabatan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_pengurus' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'masa_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],
            'masa_berakhir' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],
        ]);
        $this->dbforge->add_key('id_struktur', true);
        $this->dbforge->create_table('struktur', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('struktur');
    }
}
