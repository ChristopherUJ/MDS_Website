<?php

namespace Fuel\Migrations;

class Create_select_options {

    public function up() {
        \DBUtil::create_table('select_options', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'select_group_id' => array('constraint' => 11, 'type' => 'int'),
            'status_id' => array('constraint' => 11, 'type' => 'int'),
            'value' => array('constraint' => 250, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
                ), array('id'));
    }

    public function down() {
        \DBUtil::drop_table('select_options');
    }

}