<?php

class Controller_Admin_Records extends Controller_Admin {

    public function action_index() {
        Fuel\Core\Response::redirect('admin/records/listing');
    }

    public function action_listing() {
        $pageLimit = 20;
        $page = \Fuel\Core\Uri::segment(4) ? \Fuel\Core\Uri::segment(4) : 0;

        // Count total records
        $countRecords = Model_Dataset::getCountRecordsForDefaultDataset();
        $countPages = ceil($countRecords / $pageLimit);
        $offset = $page * $pageLimit;

        $data['currentPage'] = $page;
        $data['countRecords'] = $countRecords;
        $data['countPages'] = $countPages;
        $data['from'] = $offset;
        $data['to'] = $offset + $pageLimit;

        $data['records'] = Model_Record::find()->limit($pageLimit)->offset($offset)->get();
        $this->template->title = "Records";
        $this->template->content = View::forge('admin/records/index', $data);
    }

    public function action_view($id = null) {
        $data['record'] = Model_Record::find($id);

        is_null($id) and Response::redirect('Records');

        $this->template->title = "Record";
        $this->template->content = View::forge('admin/records/view', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            $val = Model_Record::validate('create');

            if ($val->run()) {
                $record = Model_Record::forge(array(
                            'mmsi' => Input::post('mmsi'),
                            'country' => Input::post('country'),
                            'ship_name' => Input::post('ship_name'),
                            'imo_number' => Input::post('imo_number'),
                            'ship_type' => Input::post('ship_type'),
                            'destination' => Input::post('destination'),
                            'length' => Input::post('length'),
                            'breadth' => Input::post('breadth'),
                            'maximum_actual_draught' => Input::post('maximum_actual_draught'),
                            'to_country' => Input::post('to_country'),
                            'to_port' => Input::post('to_port'),
                            'in_country' => Input::post('in_country'),
                            'in_port' => Input::post('in_port'),
                            'from_country' => Input::post('from_country'),
                            'from_port' => Input::post('from_port'),
                        ));

                if ($record and $record->save()) {
                    Session::set_flash('success', 'Added record #' . $record->id . '.');

                    Response::redirect('admin/records');
                } else {
                    Session::set_flash('error', 'Could not save record.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Records";
        $this->template->content = View::forge('admin/records/create');
    }

    public function action_edit($id = null) {
        is_null($id) and Response::redirect('Records');

        $record = Model_Record::find($id);

        $val = Model_Record::validate('edit');

        if ($val->run()) {
            $record->mmsi = Input::post('mmsi');
            $record->country = Input::post('country');
            $record->ship_name = Input::post('ship_name');
            $record->imo_number = Input::post('imo_number');
            $record->ship_type = Input::post('ship_type');
            $record->destination = Input::post('destination');
            $record->length = Input::post('length');
            $record->breadth = Input::post('breadth');
            $record->maximum_actual_draught = Input::post('maximum_actual_draught');
            $record->to_country = Input::post('to_country');
            $record->to_port = Input::post('to_port');
            $record->in_country = Input::post('in_country');
            $record->in_port = Input::post('in_port');
            $record->from_country = Input::post('from_country');
            $record->from_port = Input::post('from_port');

            if ($record->save()) {
                Session::set_flash('success', 'Updated record #' . $id);

                Response::redirect('admin/records');
            } else {
                Session::set_flash('error', 'Could not update record #' . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $record->mmsi = $val->validated('mmsi');
                $record->country = $val->validated('country');
                $record->ship_name = $val->validated('ship_name');
                $record->imo_number = $val->validated('imo_number');
                $record->ship_type = $val->validated('ship_type');
                $record->destination = $val->validated('destination');
                $record->length = $val->validated('length');
                $record->breadth = $val->validated('breadth');
                $record->maximum_actual_draught = $val->validated('maximum_actual_draught');
                $record->to_country = $val->validated('to_country');
                $record->to_port = $val->validated('to_port');
                $record->in_country = $val->validated('in_country');
                $record->in_port = $val->validated('in_port');
                $record->from_country = $val->validated('from_country');
                $record->from_port = $val->validated('from_port');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('record', $record, false);
        }

        $this->template->title = "Records";
        $this->template->content = View::forge('admin/records/edit');
    }

    public function action_delete($id = null) {
        if ($record = Model_Record::find($id)) {
            $record->delete();

            Session::set_flash('success', 'Deleted record #' . $id);
        } else {
            Session::set_flash('error', 'Could not delete record #' . $id);
        }

        Response::redirect('admin/records');
    }

}