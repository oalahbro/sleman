<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_dinas extends CI_Migration
{
    public function up()
    {
        $fields = [
            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
        ];
        $this->dbforge->add_column('dinas', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('dinas', 'logo');
    }
}
