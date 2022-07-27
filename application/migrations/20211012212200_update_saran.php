<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Update_saran extends CI_Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'    => 'ENUM("0", "1")',
                'default' => '0',
            ],
        ];
        $this->dbforge->add_column('saran', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('saran', 'status');
    }
}
