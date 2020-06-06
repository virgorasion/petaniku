<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class IMRest_server extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');

        $this->load->view('im_view/rest_server');
    }
}
