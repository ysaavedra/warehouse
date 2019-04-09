<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Ion Auth info (login purposes)
        $this->ion_auth_data['logged_user'] = $this->ion_auth->user()->row();
        $this->ion_auth_data['logged_user_group'] = $this->ion_auth->get_users_groups()->row();

        if ($this->ion_auth->logged_in()) {
            // if user is logged in set some values
            $this->ion_auth_data['logged'] = true;
            $this->ion_auth_data['staff'] = false;
        }

        $groups = array('admin', 'moderator');

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if ($this->ion_auth->in_group($groups)) {
            $this->ion_auth_data['staff'] = true;
        }
        // Some data added
        $this->ion_auth_data['page_header'] = lang('dashboard_string_page_header');
        $this->ion_auth_data['optional_description'] = lang('dashboard_string_optional_description');
        // (Breadcrumbs here, maybe.)
        /**
         *  Do the magic with the breadcrumbs.
         */
    }

}
