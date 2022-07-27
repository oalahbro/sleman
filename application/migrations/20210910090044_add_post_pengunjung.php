<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_post_pengunjung extends CI_Migration
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
            'ip_pengunjung' => [
                'type'       => 'INT',
                'constraint' => 50,
                'null'       => true,
            ],
            'id_post' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'null'       => true,
            ],
        ]);
        $this->dbforge->add_key('id_pengunjung', true);
        $this->dbforge->create_table('post_pengunjung', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('post_pengunjung');
    }
}
