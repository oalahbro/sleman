<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_video_gk extends CI_Migration
{
    public function up()
    {
        $this->dbforge->drop_column('video_gk', 'thumbnail_vid');
    }

    public function down()
    {
        $fields = [
            'thumbnail_vid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ];
        $this->dbforge->add_column('video_gk', $fields);
    }
}
