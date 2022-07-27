<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_struktur_redaksi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_struktur_redaksi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'jenis_redaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->dbforge->add_key('id_struktur_redaksi', true);
        $this->dbforge->create_table('struktur_redaksi', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('struktur_redaksi');
    }
}
