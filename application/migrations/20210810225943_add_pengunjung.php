<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_pengunjung extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_pengunjung' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'tanggal' => [
                'type' => 'TIMESTAMP',
            ],
            'ip_pengguna' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'media_browser' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);
        $this->dbforge->add_key('id_pengunjung', true);
        $this->dbforge->create_table('pengunjung', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('pengunjung');
    }
}
