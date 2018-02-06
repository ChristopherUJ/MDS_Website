<?php

/**
 * Description of TabDelimitedTextReader
 *
 * @author David Weber
 */
class TabDelimitedRecordImporter {

    public static function importRecordsFromTabDelimitedTextFile($filePath, $datasetId) {
        $recordErrors = 0;

        $fileStream = fopen($filePath, "r");
        while (!feof($fileStream)) {
            $line = ltrim(trim(fgets($fileStream, 4096)));
            $columns = explode("\t", $line);

            $index = 0;
            $record = Model_Record::forge(array(
                        'mmsi' => intval($columns[$index++]),
                        'country' => $columns[$index++] == 'Unknown' ? 'UNKNOWN' : $columns[$index++],
                        'source_type_id' => StatsUtil::getDefaultIfNull($columns[$index++], Model_Record::SOURCE_TYPE_AIS),
                        'source_name' => $columns[$index++],
                        'persons_onboard' => $columns[$index++],
                        'ship_name' => $columns[$index++],
                        'call_sign' => $columns[$index++],
                        'imo_number' => $columns[$index++] ? intval($columns[$index++]) : '',
                        'ship_type' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'destination' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'eta' => $columns[$index++],
                        'length' => StatsUtil::getDefaultIfNull($columns[$index++], -1),
                        'breadth' => StatsUtil::getDefaultIfNull($columns[$index++], -1),
                        'maximum_actual_draught' => StatsUtil::getDefaultIfNull($columns[$index++], -1),
                        'cargo' => $columns[$index++],
                        'vessel_opr' => $columns[$index++],
                        'to_country' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'to_port' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'latitude' => PositioningUtils::pretty_print_to_decimal($columns[$index++]),
                        'longitude' => PositioningUtils::pretty_print_to_decimal($columns[$index++]),
                        'time_stamp' => strtotime($columns[$index++]),
                        'sog' => $columns[$index++],
                        'max_sog' => $columns[$index++],
                        'cog' => $columns[$index++],
                        'heading' => $columns[$index++],
                        'rot' => $columns[$index++],
                        'nav_status' => $columns[$index++],
                        'pos_accuracy' => $columns[$index++],
                        'time_halted' => $columns[$index++],
                        'in_country' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'in_port' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'from_country' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'from_port' => StatsUtil::getDefaultIfNull($columns[$index++], 'UNKNOWN'),
                        'long_lat_time' => $columns[$index++],
                        'dataset_id' => $datasetId
                    ));

            if ($record && !$record->save())
                $recordErrors++;

            unset($record);
        }
        fclose($fileStream);

        return $recordErrors;
    }

}

?>
