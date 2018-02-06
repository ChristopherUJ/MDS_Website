<?php

class Controller_User extends Controller_Base {

    public $template = 'admin/template';

    public function before() {
        parent::before();

        if (!Auth::member(1) and Request::active()->action != 'login') {
            Response::redirect('user/login');
        }
    }

    public function action_login() {
        // Already logged in
        if (Auth::member(1))
            Auth::check() and Response::redirect('user');
        else
            Auth::check() and Response::redirect('admin');
        $val = Validation::forge();

        if (Input::method() == 'POST') {
            $val->add('email', 'Email or Username')
                    ->add_rule('required');
            $val->add('password', 'Password')
                    ->add_rule('required');

            if ($val->run()) {
                $auth = Auth::instance();

                // check the credentials. This assumes that you have the previous table created
                if (Auth::check() or $auth->login(Input::post('email'), Input::post('password'))) {
                    // credentials ok, go right in
                    $current_user = Model_User::find_by_username(Auth::get_screen_name());
                    Session::set_flash('success', e('Welcome, ' . $current_user->username));
                    if (Auth::member(1))
                        Response::redirect('user');
                    else
                        Response::redirect('admin');
                } else {
                    Session::set_flash('error', e('Invalid credentials'));
                }
            }
        }

        $this->template->title = 'Login';
        $this->template->content = View::forge('admin/login', array('val' => $val), false);
    }

    /**
     * The logout action.
     *
     * @access  public
     * @return  void
     */
    public function action_logout() {
        Auth::logout();
        Response::redirect('user');
    }

}

/* End of file admin.php */
