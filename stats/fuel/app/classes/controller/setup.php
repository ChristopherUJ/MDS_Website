<?php

class Controller_Setup extends \Fuel\Core\Controller {

    public function action_install() {
        $writable_paths = array(APPPATH . 'cache', APPPATH . 'logs', APPPATH . 'tmp', APPPATH . 'config');

        foreach ($writable_paths as $path) {
            if (@chmod($path, 0777)) {
                print_r("\t" . 'Made writable: ' . $path);
            } else {
                print_r("\t" . 'Failed to make writable: ' . $path);
            }
        }

        $result = Fuel\Core\Migrate::latest();

        Fuel\Core\Session::set_flash('success', print_r($result, true));
        Fuel\Core\Response::redirect('site/login');
    }

    public function action_down() {
        $result = Fuel\Core\Migrate::down();
        print_r($result);
    }

}