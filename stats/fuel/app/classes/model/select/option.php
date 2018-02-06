<?php

use Orm\Model;

class Model_Select_Option extends Model {

    const STATUS_ACTIVE = 12;
    const STATUS_INACTIVE = 13;

    protected static $_properties = array(
        'id',
        'select_group_id',
        'status_id',
        'value',
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
        $val->add_field('select_group_id', 'Select Group Id', 'required|valid_string[numeric]');
        $val->add_field('status_id', 'Status Id', 'required|valid_string[numeric]');
        $val->add_field('value', 'Value', 'required|max_length[250]');

        return $val;
    }

    static function sort($option_a, $option_b) {
        return strcasecmp($option_a->value, $option_b->value);
    }

    public function getStatus() {
        if ($this->status_id == self::STATUS_ACTIVE)
            return 'Active';
        else if ($this->status_id == self::STATUS_INACTIVE)
            return 'Inactive';
        return 'Unknown';
    }

}
