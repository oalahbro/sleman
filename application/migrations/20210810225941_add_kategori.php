<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_kategori extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 70,
            ],
        ]);
        $this->dbforge->add_key('id_kategori', true);
        $this->dbforge->create_table('kategori', true);

        $data = [
            ['nama_kategori' => 'Laporan Khusus'],
            ['nama_kategori' => 'Opini / Wacana'],
            ['nama_kategori' => 'Liputan'],
            ['nama_kategori' => 'Informasi Publik'],
            ['nama_kategori' => 'Visi & Misi'],
            ['nama_kategori' => 'Sejarah'],
            ['nama_kategori' => 'Sambutan'],
            ['nama_kategori' => 'Laporan Utama'],
        ];

        $this->db->insert_batch('kategori', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('kategori');
    }
}
