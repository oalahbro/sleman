<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_komentar extends CI_Migration
{
    public function up()
    {
        // hapus kolom "comment_image" pada tabel komentar
        $this->dbforge->drop_column('komentar', 'comment_image');
    }

    public function down()
    {
        $fields = [
            'comment_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null,
            ],
        ];
        $this->dbforge->add_column('komentar', $fields);
    }
}
