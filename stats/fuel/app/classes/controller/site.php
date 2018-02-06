<?php

class Controller_Site extends Controller_Template {

    public $template = 'admin/template';

    public function before() {
        parent::before();

        if (!Auth::check() and Request::active()->action != 'login') {
            Response::redirect('site/login');
        }

        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find_by_username(Auth::get_screen_name()) : null;

        // Set a global variable so views can use it
        View::set_global('current_user', $this->current_user);
    }

    public function action_login() {
        // Already logged in
        Auth::check() and Response::redirect('site');

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

                    Response::redirect('site');
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
        Response::redirect('site');
    }

    /**
     * The index action.
     *
     * @access  public
     * @return  void
     */
    public function action_index() {
        if (Input::method() == 'POST') {
            // Get input
            $zone = \Fuel\Core\Input::post('zone');
            $countries = \Fuel\Core\Input::post('countries');
            $dateStart = \Fuel\Core\Input::post('dateStart');
            $dateEnd = \Fuel\Core\Input::post('dateEnd');

            // Validation
            $errors = array();
            if ($zone == 'africa') {
                if (empty($countries))
                    $errors[] = 'Please specify a country';
            }
            if (empty($dateStart))
                $errors[] = 'Please specify a start date';
            if (empty($dateEnd))
                $errors[] = 'Please specify a end date';
            if (!empty($errors))
                Session::set_flash('error', implode(', ', $errors));
            else {
                Session::set('zone', \Fuel\Core\Input::post('zone'));
                Session::set('countries', \Fuel\Core\Input::post('countries'));
                Session::set('dateStart', \Fuel\Core\Input::post('dateStart'));
                Session::set('dateEnd', \Fuel\Core\Input::post('dateEnd'));

                \Fuel\Core\Response::redirect('site/vesselsinarea');
            }
        }

        $this->template->title = 'Start Session';
        $this->template->content = View::forge('admin/dashboard');
        $this->template->js_includes = array('date.js', 'daterangepicker.js');
        $this->template->css_includes = array('daterangepicker.css');
    }

    public function action_vesselsinarea() {
        if (!Model_Setting::getDatasetSettingValue()) {
            $this->template->title = 'Vessel Stats: ' . (Session::get('zone') == 'global' ? 'Global' : 'Africa');
            $this->template->content = View::forge('admin/nodataset');
            return;
        }

        if (!Session::get('zone'))
            \Fuel\Core\Response::redirect('site/index');

        // Process filters
        $filters = '';
        $location_type = Fuel\Core\Input::post('location_type', Model_Record::LOCATION_TYPE_IN_AREA);
        $countries = is_array(Fuel\Core\Session::get('countries', '%')) ? Fuel\Core\Session::get('countries', '%') : array(Fuel\Core\Session::get('countries', '%'));
        if ($location_type == Model_Record::LOCATION_TYPE_IN_PORT)
            $filters = ' AND in_country IN (' . implode(',', array_map('DB::escape', $countries)) . ') ';
        else if ($location_type == Model_Record::LOCATION_TYPE_NOT_IN_PORT)
            $filters = ' AND in_country NOT IN (' . implode(',', array_map('DB::escape', $countries)) . ') ';
        $filters .= ' AND DATE(FROM_UNIXTIME(time_stamp)) BETWEEN DATE(FROM_UNIXTIME(' . strtotime(Fuel\Core\Session::get('dateStart', '%')) . ')) AND DATE(FROM_UNIXTIME(' . strtotime(Fuel\Core\Session::get('dateEnd', '%')) . '))';

        $filter_length = Fuel\Core\Input::post('filter_length');
        if ($filter_length && is_array($filter_length))
            $filters .= " AND CONCAT(25 * FLOOR(LENGTH / 25), ' - ', 25 * FLOOR(LENGTH / 25) + 25) IN (" . implode(',', array_map('DB::escape', $filter_length)) . ") ";
        $filter_draft = Fuel\Core\Input::post('filter_draft');
        if ($filter_draft && is_array($filter_draft))
            $filters .= " AND CONCAT(2 * FLOOR(maximum_actual_draught / 2), ' - ', 2 * FLOOR(maximum_actual_draught / 2) + 2) IN (" . implode(',', array_map('DB::escape', $filter_draft)) . ") ";
        $filter_type = Fuel\Core\Input::post('filter_type');
        if ($filter_type && is_array($filter_type))
            $filters .= " AND ship_type IN (" . implode(',', array_map('DB::escape', $filter_type)) . ") ";
        $filter_destination = Fuel\Core\Input::post('filter_destination');
        if ($filter_destination && is_array($filter_destination))
            $filters .= " AND to_country IN (" . implode(',', array_map('DB::escape', $filter_destination)) . ") ";
        $filter_in_port = Fuel\Core\Input::post('filter_in_port');
        if ($filter_in_port && is_array($filter_in_port))
            $filters .= " AND in_port IN (" . implode(',', array_map('DB::escape', $filter_in_port)) . ") ";
        $filter_in_country = Fuel\Core\Input::post('filter_in_country');
        if ($filter_in_country && is_array($filter_in_country))
            $filters .= " AND in_country IN (" . implode(',', array_map('DB::escape', $filter_in_country)) . ") ";

        // Get data
        $data['lengthStats'] = Model_Dataset::getLengthStats($filters);
        $data['typeStats'] = Model_Dataset::getTypeStats($filters);
        $data['draftStats'] = Model_Dataset::getDraftStats($filters);
        $data['destinationStats'] = Model_Dataset::getDestinationStats($filters);
        $data['portStats'] = Model_Dataset::getPortStats($filters);
        $data['countryStats'] = Model_Dataset::getCountryStats($filters);

        // Setup view
        $data['title'] = 'Vessel Stats: ' . (Session::get('zone') == 'global' ? 'Global' : 'Africa');
        $data['subtitle'] = Session::get('zone') == 'global' ? '' : '(' . (implode(', ', $countries)) . ')';
        $data['dateRange'] = Session::get('dateStart') . ' to ' . Session::get('dateEnd');
        $this->template->title = $data['title'];
        $this->template->css_includes = array('chosen.css');
        $this->template->js_includes = array('flotr2.ie.min.js', 'flotr2.min.js', 'flotr2.hit.js', 'chosen.jquery.min.js');
        $this->template->content = View::forge('admin/stats', $data);
    }

    public function action_search() {
        if (Input::method() == 'POST') {
            $queryFields = array('mmsi', 'imo_number', 'ship_name', 'ship_type', 'country', 'destination', 'length', 'breadth', 'maximum_actual_draught', 'to_country', 'to_port', 'in_country', 'in_port', 'from_country', 'from_port');

            $pageLimit = 20;
            $page = \Fuel\Core\Input::post('page') ? \Fuel\Core\Input::post('page') : 0;
            $offset = $page * $pageLimit;

            $dateStart = Fuel\Core\Input::post('dateStart');
            $dateEnd = Fuel\Core\Input::post('dateEnd');

            // Count total records
            $query = DB::select(DB::expr('COUNT(*) as count'))->from('records');
            foreach (\Fuel\Core\Input::post() as $key => $value) {
                if (in_array($key, $queryFields) && !empty($value))
                    $query->where($key, 'like', '%' . $value . '%');
            }
            if ($dateStart && $dateEnd)
                $query->where('time_stamp', 'between', array(strtotime($dateStart), strtotime($dateEnd)));
            $resultArr = $query->execute()->current();
            $countRecords = intval($resultArr['count']);

            $data['currentPage'] = $page;
            $data['countRecords'] = $countRecords;
            $data['countPages'] = ceil($countRecords / $pageLimit);
            $data['from'] = $offset;
            $data['to'] = $offset + $pageLimit;
            $data['posted'] = \Fuel\Core\Input::post();

            // Get records
            $query = Model_Record::find();
            foreach (\Fuel\Core\Input::post() as $key => $value) {
                if (in_array($key, $queryFields) && !empty($value))
                    $query->where($key, 'like', \Fuel\Core\DB::escape('%' . $value . '%'));
            }
            if ($dateStart && $dateEnd)
                $query->where('time_stamp', 'between', array(strtotime($dateStart), strtotime($dateEnd)));
            $data['records'] = $query->limit($pageLimit)->offset($offset)->get();

            $this->template->title = "Search Results";
            $this->template->content = View::forge('admin/searchresults', $data);
            return;
        }

        $data = array();
        $this->template->title = "Search";
        $this->template->content = View::forge('admin/search', $data);
        $this->template->js_includes = array('date.js', 'daterangepicker.js');
        $this->template->css_includes = array('daterangepicker.css');
    }

    public function action_view($id = null) {
        $record = Model_Record::find($id);
        $data['record'] = $record;

        is_null($id) and Response::redirect('Records');

        $this->template->title = 'Viewing Record';
        $this->template->content = View::forge('admin/view', $data);
        $this->template->js_includes = array('gmap3.min.js');
    }

}