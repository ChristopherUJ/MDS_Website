<?php

namespace Fuel\Migrations;

class Create_records {

    public function up() {
        \DBUtil::create_table('records', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'mmsi' => array('constraint' => 80, 'type' => 'varchar'),
            'country' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'ship_name' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'imo_number' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'ship_type' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'destination' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'length' => array('constraint' => 11, 'type' => 'int', 'varchar' => '80', 'null' => true),
            'breadth' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'maximum_actual_draught' => array('type' => 'double', 'null' => true),
            'to_country' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'to_port' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'in_country' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'in_port' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'from_country' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'from_port' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'dataset_id' => array('constraint' => 11, 'type' => 'int'),
            'source_type_id' => array('constraint' => 11, 'type' => 'int'),
            'source_name' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'persons_onboard' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'ship_image_filename' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'call_sign' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'eta' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'cargo' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'vessel_opr' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'latitude' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'longitude' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'time_stamp' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'sog' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'max_sog' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'cog' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'heading' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'rot' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'nav_status' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'pos_accuracy' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'time_halted' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'long_lat_time' => array('constraint' => 80, 'type' => 'varchar', 'null' => true),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
                ), array('id'));
    }

    public function down() {
        \DBUtil::drop_table('records');
    }

}