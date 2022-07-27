<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_regulasi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_regulasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'judul' => [
                'type' => 'TEXT',
            ],
            'isi' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->dbforge->add_key('id_regulasi', true);
        $this->dbforge->create_table('regulasi', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('regulasi');
    }
}
