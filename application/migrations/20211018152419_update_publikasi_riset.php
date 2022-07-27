<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_publikasi_riset extends CI_Migration
{
    public function up()
    {
        // hapus kolom "icon"
        $this->dbforge->drop_column('publikasi_riset', 'icon');

        // tambah kolom "judul"
        $fields = [
            'judul_riset' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'after'      => 'nama_pembuat',
            ],
        ];
        $this->dbforge->add_column('publikasi_riset', $fields);
    }

    public function down()
    {
        // hapus kolom "judul_riset"
        $this->dbforge->drop_column('publikasi_riset', 'judul_riset');

        // tambah kolom "icon"
        $fields = [
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
        ];
        $this->dbforge->add_column('publikasi_riset', $fields);
    }
}
