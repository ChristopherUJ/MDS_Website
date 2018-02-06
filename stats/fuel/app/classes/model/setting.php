<?php

class Model_Setting extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'key',
        'value',
        'created_at',
        'updated_at'
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

    public static function updateOrCreateDatasetSetting($dataset_id) {
        // Try load setting
        $setting = self::getDatasetSetting();
        if ($setting) {
            // Setting exists, update value
            $setting->value = $dataset_id;
            $setting->save();
        }

        // Setting doesnt exists, create setting
        $setting = self::forge();
        $setting->key = 'current_dataset';
        $setting->value = $dataset_id;
        $setting->save();
    }

    public static function getDatasetSetting() {
        return self::find()->where('key', 'current_dataset')->get_one();
    }

    public static function getDatasetSettingValue() {
        $setting = self::getDatasetSetting();
        
        if ($setting)
            return $setting->value;
        
        return null;
    }

}
