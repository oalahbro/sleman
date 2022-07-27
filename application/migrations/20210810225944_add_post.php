<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_post extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_post' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'judul_post' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => true,
            ],
            'deskripsi_post' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'konten_post' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'foto_post' => [
                'type'       => 'VARCHAR',
                'constraint' => 40,
                'null'       => true,
            ],
            'tanggal_post' => [
                'type' => 'TIMESTAMP',
            ],
            'tanggal_ubah' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'id_kategori' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'unsigned'   => true,
            ],
            'permalink' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
            ],
            'post_status' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'comment'    => '1=Publish, 0=Unpublish',
                'unsigned'   => true,
            ],
            'post_views' => [
                'type'       => 'INT',
                'constraint' => 100,
                'default'    => 0,
                'unsigned'   => true,
            ],
            'id_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
        ]);
        $this->dbforge->add_key('id_post', true);
        $this->dbforge->create_table('post', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('post');
    }
}
