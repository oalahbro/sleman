<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_struktur_jabatan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_jabatan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'jenis_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->dbforge->add_key('id_jabatan', true);
        $this->dbforge->create_table('jabatan', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('jabatan');
    }
}
