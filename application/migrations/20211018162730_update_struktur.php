<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_struktur extends CI_Migration
{
    public function up()
    {
        $this->dbforge->drop_column('struktur', 'masa_berakhir');
        // $this->dbforge->drop_column('struktur', 'masa_jabatan');

        $this->dbforge->modify_column('struktur', [
            'masa_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);

        $this->dbforge->add_column('struktur', [
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        // hapus kolom "image"
        $this->dbforge->drop_column('struktur', 'image');

        // tambahkan kolom "masa_berakhir"
        $this->dbforge->add_column('struktur', [
            'masa_berakhir' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,

            ],
        ]);

        $this->dbforge->modify_column('struktur', [
            'masa_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 55,
            ],
        ]);
    }
}
