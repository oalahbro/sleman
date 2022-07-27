<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_regulasi extends CI_Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'       => 'INT',
                'constraint' => '2',
                'unsigned'   => true,
            ],
        ];
        $this->dbforge->add_column('regulasi', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('regulasi', 'status');
    }
}
