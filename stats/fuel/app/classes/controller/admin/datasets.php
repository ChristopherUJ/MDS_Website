<?php

class Controller_Admin_Datasets extends Controller_Admin {

    public function action_index() {
        $data['datasets'] = Model_Dataset::find('all');
        $this->template->title = "Datasets";
        $this->template->content = View::forge('admin/datasets/index', $data);
    }

    public function action_view($id = null) {
        $data['dataset'] = Model_Dataset::find($id);

        $this->template->title = "Dataset";
        $this->template->content = View::forge('admin/datasets/view', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            ini_set('memory_limit', '-1');
            try {
                Fuel\Core\DB::start_transaction();
                // Custom configuration for this upload
                $config = array(
                    'path' => DOCROOT . DS . 'assets' . DS . 'datasets',
                    'normalize' => true,
                    'ext_whitelist' => array('xls', 'zip'),
                );

                // process the uploaded files in $_FILES
                Upload::process($config);

                if (Upload::is_valid()) {

                    // Save the uploaded file
                    Upload::save();
                    Fuel\Core\Log::debug('File uploaded and saved!');

                    $recordErrors = false;
                    foreach (Upload::get_files() as $file) {
                        $fileName = $file['saved_as'];
                        if ($file['extension'] == 'zip') {
                            $zipFilePath = $config['path'] . DS . $fileName;
                            $unzip = new \Unzip;
                            $files = $unzip->extract($zipFilePath, $config['path']);
                            @unlink($zipFilePath);
                            $fileInfo = File::file_info($files[0]);
                            $fileName = $fileInfo['basename'];
                        }

                        // Create the dataset entry
                        $dataset = Model_Dataset::forge(array(
                                    'user_id' => $this->current_user->id,
                                    'status_id' => Model_Dataset::STATUS_PENDING,
                                    'file_name' => $fileName
                                ));
                        if ($dataset && !$dataset->save())
                            throw new Exception('Failed to process dataset');
                        Fuel\Core\Log::debug('Dataset entry created!');

                        // Load records from file
                        $inputFileName = $config['path'] . DS . $fileName;
                        $excelData = new Spreadsheet_Excel_Reader($inputFileName, false);
                        $highestRow = $excelData->rowcount();
                        Fuel\Core\Log::debug('Excel data loaded!');

                        // Loop through records, process and store values
                        $values = array();
                        for ($row = 2; $row <= $highestRow; ++$row) {
                            if (!$excelData->value($row, 1))
                                continue;

                            $columns = array(
                                'mmsi' => intval($excelData->value($row, 1)),
                                'country' => $excelData->value($row, 2) == 'Unknown' ? 'UNKNOWN' : $excelData->value($row, 2),
                                'source_type_id' => StatsUtil::getSourceTypeIdFromString(StatsUtil::getDefaultIfNull($excelData->value($row, 3), Model_Record::SOURCE_TYPE_AIS)),
                                'source_name' => $excelData->value($row, 4),
                                'persons_onboard' => $excelData->value($row, 5),
                                'ship_name' => $excelData->value($row, 6),
                                'call_sign' => $excelData->value($row, 7),
                                'imo_number' => $excelData->value($row, 8) ? intval($excelData->value($row, 8)) : '',
                                'ship_type' => StatsUtil::getDefaultIfNull($excelData->value($row, 9), 'UNKNOWN'),
                                'destination' => StatsUtil::getDefaultIfNull($excelData->value($row, 10), 'UNKNOWN'),
                                'eta' => $excelData->value($row, 11),
                                'length' => StatsUtil::getDefaultIfNull($excelData->value($row, 12), -1),
                                'breadth' => StatsUtil::getDefaultIfNull($excelData->value($row, 13), -1),
                                'maximum_actual_draught' => StatsUtil::getDefaultIfNull($excelData->value($row, 14), -1),
                                'cargo' => $excelData->value($row, 15),
                                'vessel_opr' => $excelData->value($row, 16),
                                'to_country' => StatsUtil::getDefaultIfNull($excelData->value($row, 17), 'UNKNOWN'),
                                'to_port' => StatsUtil::getDefaultIfNull($excelData->value($row, 18), 'UNKNOWN'),
                                'latitude' => PositioningUtils::pretty_print_to_decimal($excelData->value($row, 19)),
                                'longitude' => PositioningUtils::pretty_print_to_decimal($excelData->value($row, 20)),
                                'time_stamp' => strtotime($excelData->value($row, 21)),
                                'sog' => $excelData->value($row, 22),
                                'max_sog' => $excelData->value($row, 23),
                                'cog' => $excelData->value($row, 24),
                                'heading' => $excelData->value($row, 25),
                                'rot' => $excelData->value($row, 26),
                                'nav_status' => $excelData->value($row, 27),
                                'pos_accuracy' => $excelData->value($row, 28),
                                'time_halted' => $excelData->value($row, 29),
                                'in_country' => StatsUtil::getDefaultIfNull($excelData->value($row, 30), 'UNKNOWN'),
                                'in_port' => StatsUtil::getDefaultIfNull($excelData->value($row, 31), 'UNKNOWN'),
                                'from_country' => StatsUtil::getDefaultIfNull($excelData->value($row, 32), 'UNKNOWN'),
                                'from_port' => StatsUtil::getDefaultIfNull($excelData->value($row, 33), 'UNKNOWN'),
                                'long_lat_time' => $excelData->raw($row, 34),
                                'dataset_id' => $dataset->id,
                                'created_at' => \Date::time()->get_timestamp()
                            );

                            $values[] = '(' . implode(', ', array_map('DB::escape', $columns)) . ')';

                            if (sizeof($values) >= 50) {
                                set_time_limit(60);
                                \Fuel\Core\DB::query('INSERT INTO `records` (`mmsi`, `country`, `source_type_id`, `source_name`, `persons_onboard`, `ship_name`, `call_sign`, `imo_number`, `ship_type`, `destination`, `eta`, `length`, `breadth`, `maximum_actual_draught`, `cargo`, `vessel_opr`, `to_country`, `to_port`, `latitude`, `longitude`, `time_stamp`, `sog`, `max_sog`, `cog`, `heading`, `rot`, `nav_status`, `pos_accuracy`, `time_halted`, `in_country`, `in_port`, `from_country`, `from_port`, `long_lat_time`, `dataset_id`, `created_at`) VALUES ' . implode(',', $values), \Fuel\Core\DB::INSERT)->execute();
                                $values = array();
                            }
                        }

                        if (sizeof($values) > 0)
                            \Fuel\Core\DB::query('INSERT INTO `records` (`mmsi`, `country`, `source_type_id`, `source_name`, `persons_onboard`, `ship_name`, `call_sign`, `imo_number`, `ship_type`, `destination`, `eta`, `length`, `breadth`, `maximum_actual_draught`, `cargo`, `vessel_opr`, `to_country`, `to_port`, `latitude`, `longitude`, `time_stamp`, `sog`, `max_sog`, `cog`, `heading`, `rot`, `nav_status`, `pos_accuracy`, `time_halted`, `in_country`, `in_port`, `from_country`, `from_port`, `long_lat_time`, `dataset_id`, `created_at`) VALUES ' . implode(',', $values), \Fuel\Core\DB::INSERT)->execute();
                        Fuel\Core\Log::debug('Records saved!');

                        // Clean up
                        unset($excelData);

                        // Update the dataset entry
                        $dataset->status_id = $recordErrors ? Model_Dataset::STATUS_ERROR : Model_Dataset::STATUS_PROCESSED;
                        if ($dataset && !$dataset->save())
                            throw new Exception('Failed to process dataset');

                        // Update dataset setting
                        Model_Setting::updateOrCreateDatasetSetting($dataset->id);
                    }
                } else {
                    foreach (Upload::get_errors() as $file) {
                        throw new Exception(print_r($file['errors'], true));
                    }
                    throw new Exception('Invalid file uploaded!');
                }

                Fuel\Core\DB::commit_transaction();
                Session::set_flash('success', e('Created dataset #' . $dataset->id));
                Fuel\Core\Response::redirect('admin/datasets');
            } catch (Exception $ex) {
                Session::set_flash('error', e($ex->getMessage()));
                Fuel\Core\DB::rollback_transaction();
            }
        }

        $this->template->title = "Datasets";
        $this->template->content = View::forge('admin/datasets/create');
    }

    public function action_setdefault($dataset_id) {
        // Update dataset setting
        if ($dataset_id) {
            Model_Setting::updateOrCreateDatasetSetting($dataset_id);
            Session::set_flash('success', e('Set dataset #' . $dataset_id . ' as default'));
        }

        \Fuel\Core\Response::redirect('admin/datasets');
    }

    public function action_edit($id = null) {
        $dataset = Model_Dataset::find($id);
        $val = Model_Dataset::validate('edit');

        if ($val->run()) {
            $dataset->user_id = Input::post('user_id');
            $dataset->status_id = Input::post('status_id');
            $dataset->file_name = Input::post('file_name');

            if ($dataset->save()) {
                Session::set_flash('success', e('Updated dataset #' . $id));

                Response::redirect('admin/datasets');
            } else {
                Session::set_flash('error', e('Could not update dataset #' . $id));
            }
        } else {
            if (Input::method() == 'POST') {
                $dataset->user_id = $val->validated('user_id');
                $dataset->status_id = $val->validated('status_id');
                $dataset->file_name = $val->validated('file_name');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('dataset', $dataset, false);
        }

        $this->template->title = "Datasets";
        $this->template->content = View::forge('admin/datasets/edit');
    }

    public function action_delete($id = null) {
        if ($dataset = Model_Dataset::find($id)) {

            // Delete records
            $result = DB::delete('records')->where('dataset_id', $dataset->id)->execute();

            // Delete dataset
            $dataset->delete();

            // Delete file
            try {
                File::delete(APPPATH . 'datasets' . DS . $dataset->file_name);
            } catch (Exception $ig) {
                
            }

            Session::set_flash('success', e('Deleted dataset #' . $id));
        } else {
            Session::set_flash('error', e('Could not delete dataset #' . $id));
        }

        Response::redirect('admin/datasets');
    }

}