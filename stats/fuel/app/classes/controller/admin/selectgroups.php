<?php

class Controller_Admin_SelectGroups extends Controller_Admin {

    public function action_index() {
        $data['select_groups'] = Model_Select_Group::find('all');
        $this->template->title = "Select Groups";
        $this->template->content = View::forge('admin/select/groups/index', $data);
    }

    public function action_view($id = null) {
        $data['select_group'] = Model_Select_Group::find($id);

        is_null($id) and Response::redirect('admin/selectgroups');

        $this->template->title = "Select Group";
        $this->template->content = View::forge('admin/select/groups/view', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            $val = Model_Select_Group::validate('create');

            if ($val->run()) {
                $select_group = Model_Select_Group::forge(array(
                            'name' => Input::post('name'),
                            'description' => Input::post('description'),
                        ));

                if ($select_group and $select_group->save()) {
                    Session::set_flash('success', 'Added select group #' . $select_group->id . '.');

                    Response::redirect('admin/selectgroups');
                } else {
                    Session::set_flash('error', 'Could not save select group.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Select Groups";
        $this->template->content = View::forge('admin/select/groups/create');
    }

    public function action_edit($id = null) {
        is_null($id) and Response::redirect('admin/selectgroups');

        $select_group = Model_Select_Group::find($id);

        $val = Model_Select_Group::validate('edit');

        if ($val->run()) {
            $select_group->name = Input::post('name');
            $select_group->description = Input::post('description');

            if ($select_group->save()) {
                Session::set_flash('success', 'Updated select group #' . $id);

                Response::redirect('admin/selectgroups');
            } else {
                Session::set_flash('error', 'Could not update select group #' . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $select_group->name = $val->validated('name');
                $select_group->description = $val->validated('description');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('select_group', $select_group, false);
        }

        $this->template->title = "Select Groups";
        $this->template->content = View::forge('admin/select/groups/edit');
    }

    public function action_delete($id = null) {
        if ($select_group = Model_Select_Group::find($id)) {
            $select_group->delete();

            Session::set_flash('success', 'Deleted select group #' . $id);
        } else {
            Session::set_flash('error', 'Could not delete select group #' . $id);
        }

        Response::redirect('admin/selectgroups');
    }

}