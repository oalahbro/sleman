<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_aspirasi extends CI_Migration
{
    public function up()
    {
        $fields = [
            'read_msg' => [
                'type'       => 'INT',
                'constraint' => '2',
                'null'       => false,
                'unsigned'   => true,
                'comment'    => 'apakah pesan tersebut sudah dibaca atau belum',
            ],
        ];
        $this->dbforge->add_column('aspirasi', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('aspirasi', 'read_msg');
    }
}
