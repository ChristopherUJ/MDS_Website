<?php

class Model_Dataset extends \Orm\Model {

    const STATUS_PENDING = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_ERROR = 2;

    protected static $_properties = array(
        'id',
        'user_id',
        'status_id',
        'file_name',
        'created_at',
        'updated_at',
    );
    protected static $_has_many = array('records' => array(
            'model_to' => 'Model_Record',
            'key_from' => 'id',
            'key_to' => 'dataset_id',
            'cascade_save' => false,
            'cascade_delete' => false,
            ));
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
        $val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
        $val->add_field('status_id', 'Status Id', 'required|valid_string[numeric]');
        $val->add_field('file_name', 'File Name', 'max_length[200]');

        return $val;
    }

    public function getStatus() {
        switch ($this->status_id) {
            case self::STATUS_PENDING:
                return '<span class="label">Pending</span>';
            case self::STATUS_PROCESSED:
                return '<span class="label label-success">Processed</span>';
            case self::STATUS_ERROR:
                return '<span class="label label-warning">Errors</span>';
            default :
                return '<span class="label label-inverse">Unknown</span>';
        }
    }

    public static function getCountRecordsForDefaultDataset() {
        $result = DB::select(DB::expr('COUNT(*) as count'))->from('records')->execute();
        $resultArr = $result->current();
        return intval($resultArr['count']);
    }

    public function getCountRecords() {
        $result = DB::select(DB::expr('COUNT(*) as count'))->from('records')->where('dataset_id', $this->id)->execute();
        $resultArr = $result->current();
        return intval($resultArr['count']);
    }

    public static function getTypeStats($filters = '') {
        $query = \Fuel\Core\DB::query('SELECT SUBSTRING(ship_type, 1, 30) as ship_type, COUNT(*) FROM (select * from records  WHERE 1 = 1 ' . $filters . ' group by mmsi) r GROUP BY ship_type ORDER BY COUNT(*) desc');
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'ship_type', 'COUNT(*)');
    }

    public static function getLengthStats($filters = '') {
        $sql = "SELECT CONCAT(25 * FLOOR(LENGTH / 25), ' - ', 25 * FLOOR(LENGTH / 25) + 25) AS agg, COUNT(*) FROM (select * from records WHERE 1 = 1 " . $filters . " group by mmsi) r GROUP BY 1 ORDER BY LENGTH";
        $query = \Fuel\Core\DB::query($sql);
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'agg', 'COUNT(*)');
    }

    public static function getDestinationStats($filters = '') {
        $query = \Fuel\Core\DB::query('SELECT to_country, COUNT(*) FROM (select * from records WHERE 1 = 1 ' . $filters . ' group by mmsi) r GROUP BY to_country ORDER BY COUNT(*) desc');
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'to_country', 'COUNT(*)');
    }

    public static function getDraftStats($filters = '') {
        $query = \Fuel\Core\DB::query("SELECT CONCAT(2 * FLOOR(maximum_actual_draught / 2), ' - ', 2 * FLOOR(maximum_actual_draught / 2) + 2) AS agg, COUNT(*) FROM (select * from records WHERE 1 = 1 " . $filters . " group by mmsi) r GROUP BY 1 ORDER BY maximum_actual_draught");
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'agg', 'COUNT(*)');
    }

    public static function getPortStats($filters = '') {
        $query = \Fuel\Core\DB::query('SELECT in_port, COUNT(*) FROM (select * from records WHERE 1 = 1 ' . $filters . ' group by mmsi) r GROUP BY in_port ORDER BY COUNT(*) desc');
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'in_port', 'COUNT(*)');
    }

    public static function getCountryStats($filters = '') {
        $query = \Fuel\Core\DB::query('SELECT in_country, COUNT(*) FROM (select * from records WHERE 1 = 1 ' . $filters . ' group by mmsi) r GROUP BY in_country ORDER BY COUNT(*) desc');
        $result = $query->execute();
        return Arr::assoc_to_keyval($result->as_array(), 'in_country', 'COUNT(*)');
    }

    public static function getHorizontalGraphDataForRecords($records, $generateTicks = true) {
        $holder = array();

        // Generate type mapping
        $typeMapping = array();
        foreach ($records as $recordType => $count) {
            $typeMapping[] = $recordType;
        }
        $typeMapping = array_unique($typeMapping);

        // Generate data pairs
        $jsonArray = '[';
        foreach ($records as $recordType => $count) {
            $jsonArray .= '[' . $count . ',' . array_search($recordType, $typeMapping) . '],';
        }
        $jsonArray .= ']';
        $holder['data'] = $jsonArray;

        if ($generateTicks) {
            // Generate ticks
            $jsonArray = '[';
            for ($index = 0; $index < count($typeMapping); $index++) {
                $jsonArray .= '[' . $index . ',"' . $typeMapping[$index] . '"],';
            }
            $jsonArray .= ']';
            $holder['ticks'] = $jsonArray;
        }

        return $holder;
    }

    public static function getVerticalGraphDataForRecords($records, $generateTicks = true) {
        $holder = array();

        // Generate type mapping
        $typeMapping = array();
        foreach ($records as $recordType => $count) {
            $typeMapping[] = $recordType;
        }
        $typeMapping = array_unique($typeMapping);

        // Generate data pairs
        $jsonArray = '[';
        foreach ($records as $recordType => $count) {
            $jsonArray .= '[' . array_search($recordType, $typeMapping) . ',' . $count . '],';
        }
        $jsonArray .= ']';
        $holder['data'] = $jsonArray;

        if ($generateTicks) {
            // Generate ticks
            $jsonArray = '[';
            for ($index = 0; $index < count($typeMapping); $index++) {
                $jsonArray .= '[' . $index . ',"' . $typeMapping[$index] . '"],';
            }
            $jsonArray .= ']';
            $holder['ticks'] = $jsonArray;
        }

        return $holder;
    }

}
