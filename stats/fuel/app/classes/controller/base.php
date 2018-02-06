<?php

class Controller_Base extends Controller_Template {

    public function before() {
        parent::before();

        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find_by_username(Auth::get_screen_name()) : null;

        // Set a global variable so views can use it
        View::set_global('current_user', $this->current_user);
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

                if (Auth::member(100))
                    \Fuel\Core\Response::redirect('admin/vesselsinarea');
                else
                    \Fuel\Core\Response::redirect('user/vesselsinarea');
            }
        }

        $this->template->title = 'Dashboard';
        $this->template->content = View::forge('admin/dashboard');
        $this->template->js_includes = array('date.js', 'daterangepicker.js');
        $this->template->css_includes = array('daterangepicker.css');
    }

    public function action_vesselsinarea() {
        if (!Auth::check())
            die('Not Logged In');

        // Process filters
        $filters = '';
        $location_type = Fuel\Core\Input::post('location_type', Model_Record::LOCATION_TYPE_IN_AREA);
        $countries = is_array(Fuel\Core\Session::get('countries', '%')) ? Fuel\Core\Session::get('countries', '%') : array(Fuel\Core\Session::get('countries', '%'));
        if ($location_type == Model_Record::LOCATION_TYPE_IN_PORT)
            $filters = ' AND in_country IN (' . implode(',', array_map('DB::escape', $countries)) . ') ';
        else if ($location_type == Model_Record::LOCATION_TYPE_NOT_IN_PORT)
            $filters = ' AND in_country NOT IN (' . implode(',', array_map('DB::escape', $countries)) . ') ';

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

        // Get data
        $data['lengthStats'] = Model_Dataset::getLengthStats($filters);
        $data['typeStats'] = Model_Dataset::getTypeStats($filters);
        $data['draftStats'] = Model_Dataset::getDraftStats($filters);
        $data['destinationStats'] = Model_Dataset::getDestinationStats($filters);
        
        // Setup view
        $data['title'] = 'Vessel Stats: ' . (Session::get('zone') == 'global' ? 'Global' : 'Africa');
        $data['subtitle'] = Session::get('zone') == 'global' ? '' : '(' . (implode(', ', $countries)) . ')';
        $data['dateRange'] = Session::get('dateStart') . ' - ' . Session::get('dateEnd');
        $this->template->title = $data['title'];
        $this->template->css_includes = array('chosen.css');
        $this->template->js_includes = array('flotr2.ie.min.js', 'flotr2.min.js', 'chosen.jquery.min.js');
        $this->template->content = View::forge('admin/stats', $data);
    }

}