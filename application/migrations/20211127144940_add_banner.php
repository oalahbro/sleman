<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Add_banner extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_banner' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'foto_banner' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'link_banner' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'status_banner' => [
                'type'       => 'INT',
                'constraint' => 2,
                'unsigned'   => true,
            ],
        ]);
        $this->dbforge->add_key('id_banner', true);
        $this->dbforge->create_table('banner', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('banner');
    }
}
