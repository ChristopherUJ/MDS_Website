<?php

class Controller_Admin_SelectOptions extends Controller_Admin {

    public function action_index() {
        Response::redirect('admin/selectgroups');
    }

    public function action_create($select_group_id = null) {
        if (Input::method() == 'POST') {
            $val = Model_Select_Option::validate('create');

            if ($val->run()) {
                $select_option = Model_Select_Option::forge(array(
                            'select_group_id' => Input::post('select_group_id'),
                            'status_id' => Input::post('status_id'),
                            'key' => Input::post('key'),
                            'value' => Input::post('value'),
                        ));

                if ($select_option and $select_option->save()) {
                    Session::set_flash('success', 'Added select option #' . $select_option->id . '.');

                    Response::redirect('admin/selectgroups/view/' . Input::post('select_group_id'));
                } else {
                    Session::set_flash('error', 'Could not save select option.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $select_group = Model_Select_Group::find($select_group_id);
        $this->template->set_global('select_group', $select_group, false);
        $this->template->title = "Select Options";
        $this->template->content = View::forge('admin/select/options/create');
    }

    public function action_edit($id = null) {
        is_null($id) and Response::redirect('admin/selectgroups');

        $select_option = Model_Select_Option::find($id);

        $val = Model_Select_Option::validate('edit');

        if ($val->run()) {
            $select_option->select_group_id = Input::post('select_group_id');
            $select_option->status_id = Input::post('status_id');
            $select_option->value = Input::post('value');

            if ($select_option->save()) {
                Session::set_flash('success', 'Updated select_option #' . $id);

                Response::redirect('admin/selectgroups/view/' . $select_option->select_group_id);
            } else {
                Session::set_flash('error', 'Could not update select_option #' . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $select_option->select_group_id = $val->validated('select_group_id');
                $select_option->status_id = $val->validated('status_id');
                $select_option->value = $val->validated('value');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('select_option', $select_option, false);
        }

        $select_group = Model_Select_Group::find($select_option->select_group_id);
        $this->template->set_global('select_group', $select_group, false);
        $this->template->title = "Select Options";
        $this->template->content = View::forge('admin/select/options/edit');
    }

    public function action_delete($id = null) {
        if ($select_option = Model_Select_Option::find($id)) {
            $select_option->delete();

            Session::set_flash('success', 'Deleted select option #' . $id);
            Response::redirect('admin/selectgroups/view/' . $select_option->select_group_id);
        } else {
            Session::set_flash('error', 'Could not delete select option #' . $id);
            Response::redirect('admin/selectgroups');
        }
    }

}