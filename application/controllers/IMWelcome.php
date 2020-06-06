<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IMWelcome extends CI_Controller {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('IMUser_Model');
        $this->load->library("session");
        $this->load->helper('url');
        if($this->load->is_loaded("CI_Minifier")){
            $this->ci_minifier->enable_obfuscator(3);
        }
    }

	public function index()
	{
        $data["token"]=$this->input->get('token', TRUE);
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        //if block determines if a user is already login in this system
        if($this->session->userdata("session_token")!=null){ // if session has a token
            if($this->session->userdata("type")=="user"){    // and the type is 'user'
                if ($this->agent->is_mobile())  // if mobile phone
                {
                    redirect(base_url("immobile"));  // then redirect him to mobile page
                }else{
                    redirect(base_url("imuserview")); // then redirect him to userview page
                }

            }
            else if($this->session->userdata("type")=="admin"){   // and if the type is 'admin'
                $this->session->set_userdata("session_token",null);  // set the session token variable to null
                $this->load->view('im_view/welcome_message',$data);  //then show him the user login page. because admin url is different
            }                                                // admin url is http://www.example.com/admin
        }
        // if no user is login then this else block will be execute
        else{
            $this->load->view('im_view/layout/header',$data);   // loading application/views/layout/header.php
            $this->load->view('im_view/layout/navbar_empty');// loading application/views/layout/navbar_empty.php
            $this->load->view('im_view/welcome_message',$data);// loading application/welcome_message.php
            $this->load->view('im_view/layout/header_script',$data);
            $this->load->view('im_view/welcome_script',$data);

        }

	}

}
