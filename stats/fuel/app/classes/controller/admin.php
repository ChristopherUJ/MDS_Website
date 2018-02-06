<?php

class Controller_Admin extends Controller_Site {

    public function before() {
        parent::before();

        if (!Auth::member(100) and Request::active()->action != 'login') {
            Response::redirect('admin/login');
        }
    }

}

/* End of file admin.php */
