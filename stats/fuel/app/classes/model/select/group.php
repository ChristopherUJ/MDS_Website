<?php

use Orm\Model;

class Model_Select_Group extends Model {

    const GROUP_BRANCHES = 'usergroups';
    const GROUP_STATUSES = 'statuses';

    protected static $_has_many = array(
        'select_options' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Select_Option',
            'key_to' => 'select_group_id',
            'cascade_save' => false,
            'cascade_delete' => true,
        )
    );
    protected static $_properties = array(
        'id',
        'name',
        'description',
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
        $val->add_field('name', 'Name', 'required|max_length[50]');
        $val->add_field('description', 'Description', 'required|max_length[250]');

        return $val;
    }

    /**
     * Returns an associative array of value=>label pairs for the supplied select group
     * @param type $group_name
     * @return type 
     */
    public static function getSelectOptionsAsArray($group_name, $please_select = false, $sort = false) {
        $options = array();

        if ($please_select)
            $options[''] = 'Please Select';

        // Get options
        $select_group = self::find()->where('name', $group_name)->get_one();
        $select_options = $select_group->select_options;

        // Sort options
        if ($sort)
            usort($select_options, array('Model_Select_Option', 'sort'));

        // Format options
        foreach ($select_options as $select_option) {
            $options[$select_option->id] = $select_option->value;
        }

        return $options;
    }

    /**
     * Returns the select options for the supplied select group
     * @param type $group_name
     * @return type 
     */
    public static function getSelectOptions($group_name, $sort = false) {
        $select_group = self::find()->where('name', $group_name)->get_one();

        $select_options = $select_group->select_options;

        // Sort options
        if ($sort)
            usort($select_options, array('Model_Select_Option', 'sort'));

        return $select_options;
    }

}
