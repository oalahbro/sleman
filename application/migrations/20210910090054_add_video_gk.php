<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_video_gk extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_video' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'judul_vid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi_vid' => [
                'type' => 'TEXT',
            ],
            'tanggal_vid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'thumbnail_vid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->dbforge->add_key('id_video', true);
        $this->dbforge->create_table('video_gk', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('video_gk');
    }
}
