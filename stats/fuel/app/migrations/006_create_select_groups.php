<?php

namespace Fuel\Migrations;

class Create_select_groups {

    public function up() {
        \DBUtil::create_table('select_groups', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'name' => array('constraint' => 50, 'type' => 'varchar'),
            'description' => array('constraint' => 250, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
                ), array('id'));
    }

    public function down() {
        \DBUtil::drop_table('select_groups');
    }

}