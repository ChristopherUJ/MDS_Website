<?php

use Orm\Model;

class Model_Record extends Model {

    const LOCATION_TYPE_IN_AREA = 1;
    const LOCATION_TYPE_IN_PORT = 2;
    const LOCATION_TYPE_NOT_IN_PORT = 3;
    const SOURCE_TYPE_AIS = 1;
    const SOURCE_TYPE_RADAR = 2;

    protected static $_properties = array(
        'id',
        'mmsi',
        'country',
        'ship_name',
        'imo_number',
        'ship_type',
        'destination',
        'length',
        'breadth',
        'maximum_actual_draught',
        'to_country',
        'to_port',
        'in_country',
        'in_port',
        'from_country',
        'from_port',
        'dataset_id',
        'source_type_id',
        'source_name',
        'persons_onboard',
        'ship_image_filename',
        'call_sign',
        'eta',
        'cargo',
        'vessel_opr',
        'latitude',
        'longitude',
        'time_stamp',
        'sog',
        'max_sog',
        'cog',
        'heading',
        'rot',
        'nav_status',
        'pos_accuracy',
        'time_halted',
        'long_lat_time',
        'created_at',
        'updated_at',
    );
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        ),
    );

    public static function validate($factory) {
        $val = Validation::forge($factory);
        $val->add_field('mmsi', 'Mmsi', 'required|max_length[80]');
        $val->add_field('country', 'Country', 'max_length[80]');
        $val->add_field('ship_name', 'Ship Name', 'max_length[80]');
        $val->add_field('imo_number', 'Imo Number', 'max_length[80]');
        $val->add_field('ship_type', 'Ship Type', 'max_length[80]');
        $val->add_field('destination', 'Destination', 'max_length[80]');
        $val->add_field('length', 'Length', 'valid_string[numeric]');
        $val->add_field('breadth', 'Breadth', 'valid_string[numeric]');
        $val->add_field('maximum_actual_draught', 'Maximum Actual Draught', 'required');
        $val->add_field('to_country', 'To Country', 'max_length[80]');
        $val->add_field('to_port', 'To Port', 'max_length[80]');
        $val->add_field('in_country', 'In Country', 'max_length[80]');
        $val->add_field('in_port', 'In Port', 'max_length[80]');
        $val->add_field('from_country', 'From Country', 'max_length[80]');
        $val->add_field('from_port', 'From Port', 'max_length[80]');
        $val->add_field('source_type_id', 'Source Type', 'valid_string[numeric]');

        return $val;
    }

    public function getLength() {
        return $this->length == -1 ? 'UNKNOWN' : $this->length;
    }

    public function getBreadth() {
        return $this->breadth == -1 ? 'UNKNOWN' : $this->breadth;
    }

    public function getMaximumActualDraught() {
        return $this->maximum_actual_draught == -1 ? 'UNKNOWN' : $this->maximum_actual_draught;
    }

}
