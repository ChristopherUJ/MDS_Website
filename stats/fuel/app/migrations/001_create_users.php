<?php

namespace Fuel\Migrations;

class Create_users {

    public function up() {
        \DBUtil::create_table('users', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'username' => array('constraint' => 50, 'type' => 'varchar'),
            'password' => array('constraint' => 255, 'type' => 'varchar'),
            'group' => array('constraint' => 11, 'type' => 'int'),
            'email' => array('constraint' => 255, 'type' => 'varchar'),
            'last_login' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'login_hash' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
            'profile_fields' => array('type' => 'text', 'null' => true),
            'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
                ), array('id'));

        \Auth\Auth::create_user('david', 'W33d2604', 'dpweberza@gmail.com', 100);
        \Auth\Auth::create_user('paulw', 'wackers', 'paulw@mdsol.co.za', 100);
        \Auth\Auth::create_user('steve', '2012', 'steve@mdsol.co.za', 100);
        \Auth\Auth::create_user('bruce', '2012', 'bruce@mdsol.co.za', 100);
        \Auth\Auth::create_user('cleeve', '2012', 'cleeves@mdsol.co.za', 100);
        \Auth\Auth::create_user('demo', 'mdsol', 'info@mdsol.co.za', 1);
    }

    public function down() {
        \DBUtil::drop_table('users');
    }

}