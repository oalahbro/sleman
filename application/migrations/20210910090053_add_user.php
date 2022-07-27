<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'id_role' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'foto_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 75,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ubah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ubah_password' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],
        ]);
        $this->dbforge->add_key('id_user', true);
        $this->dbforge->add_key('id_role');
        $this->dbforge->create_table('user', true);

        // insert "admin"
        $data = [
            'id_user'       => 'USR0000',
            'id_role'       => '1',
            'foto_user'     => 'profile.png',
            'nama_user'     => 'Dewan Admin',
            'deskripsi'     => 'Saya adalah administrator',
            'email'         => 'admin@dewandiksleman.com',
            'password'      => password_hash('admin', PASSWORD_DEFAULT),
            'tanggal'       => time(),
            'ubah'          => time(),
            'ubah_password' => time(),
            'status'        => '1',
        ];

        $this->db->insert('user', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}
