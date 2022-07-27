<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_komentar extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_komentar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'tanggal_komentar' => [
                'type' => 'TIMESTAMP',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 90,
                'null'       => true,
            ],
            'pesan' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'unsigned'   => true,
            ],
            'komentar_parent' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'unsigned'   => true,
            ],
            'id_post' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => null,
                'unsigned'   => true,
            ],
            'comment_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null,
            ],
        ]);
        $this->dbforge->add_key('id_komentar', true);
        $this->dbforge->create_table('komentar', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('komentar');
    }
}
