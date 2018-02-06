<?php

class StatsUtil {

    public static function getDefaultIfNull($value, $default) {
        if ($value)
            return $value;
        else
            return $default;
    }

    public static function getSourceTypeIdFromString($value) {
        if ($value == 'AIS')
            return Model_Record::SOURCE_TYPE_AIS;
        else if ($value == 'RADAR')
            return Model_Record::SOURCE_TYPE_RADAR;

        return 0;
    }

}

?>
