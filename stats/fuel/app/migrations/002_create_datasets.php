<?php

namespace Fuel\Migrations;

class Create_datasets {

    public function up() {
        \DBUtil::create_table('datasets', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'status_id' => array('constraint' => 11, 'type' => 'int'),
            'file_name' => array('constraint' => 200, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
                ), array('id'));
    }

    public function down() {
        \DBUtil::drop_table('datasets');
    }

}