<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_aspirasi extends CI_Migration
{
    public function up()
    {
        // hapus tabel saran
        $this->dbforge->drop_table('saran');

        // buat tabel aspirasi sebagai pengganti
        $this->dbforge->add_field([
            'id_aspirasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'comment'    => 'Nama Pengirim aspirasi',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'comment'    => 'alamat email Pengirim aspirasi',
            ],
            'isi' => [
                'type'    => 'TEXT',
                'comment' => 'isi aspirasi',
            ],
            'tipe' => [
                'type'    => 'ENUM("kritik", "saran")',
                'default' => 'saran',
                'comment' => 'aspirasi berupa kritik / saran',
            ],
            'tanggal' => [
                'type'    => 'DATETIME',
                'comment' => 'tanggal aspirasi dikirim',
            ],
            'slider' => [
                'type'    => 'ENUM("0", "1")',
                'default' => '0',
                'comment' => 'apakah dijadikan untuk slider? 1 = ya, 0 = tidak',
            ],
            'status' => [
                'type'    => 'ENUM("0", "1")',
                'default' => '0',
                'comment' => 'dipublikasikan atau tidak? 1 = ya, 0 = tidak',
            ],
        ]);
        $this->dbforge->add_key('id_aspirasi', true);
        $this->dbforge->create_table('aspirasi', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('aspirasi');

        $this->dbforge->add_field([
            'id_saran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'email_saran' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'saran' => [
                'type' => 'TEXT',
            ],
            'foto_publik' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'status' => [
                'type'    => 'ENUM("0", "1")',
                'default' => '0',
            ],
        ]);
        $this->dbforge->add_key('id_saran', true);
        $this->dbforge->create_table('saran', true);
    }
}
