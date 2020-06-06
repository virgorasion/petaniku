<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 12/20/2016
 * Time: 11:29 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class IMMobile extends CI_Controller {


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

    function index(){
        $resToken=$this->session->userdata("responseToken");
        if(!ID_LOGIN) {
            if ($this->session->userdata("session_token") != null) {  // checking session token is null or not
                if ($this->IMUser_Model->isValidToken($resToken)) {
                    redirect(base_url("immobile/im"));
                } else { // if the response token is not valid
                    redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
                }
            } else { // if the session token is null
                redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
            }
        }else{
            if ($this->session->userdata("session_token") != null) {  // checking session token is null or not
                if ($resToken!=null || trim($resToken)!="") {
                    redirect(base_url("immobile/im"));
                } else { // if the response token is not valid
                    redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
                }
            } else { // if the session token is null
                redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
            }
        }
    }

    function logout(){
        $this->session->set_userdata("session_token",null); // setting the session token to null
        $this->session->set_userdata("responseToken",null);// setting the response token to null
        $this->session->sess_destroy(); // destroying the current session
        redirect(base_url());
    }

    function loginSuccess(){ //http://www.example.com/admin/loginSuccess
        $data["token"]=$this->input->get('r', TRUE); // collecting response token from url query param
        $data["var"]=$this->config->item("app_dv_var");
        $token=md5(date(DATE_ISO8601, strtotime("now"))); // creating a session token
        $this->session->set_userdata("session_token",$token); // assigning the session to the current session
        $this->session->set_userdata("responseToken",$data["token"]);// assigning the response token to the current session
        $this->session->set_userdata("type","user"); // setting up the user type
        // if(!ID_LOGIN) {
        //     if ($this->IMUser_Model->isValidToken($data["token"])) {
        //         redirect(base_url("immobile")); // redirecting to http://www.example.com/admin/dashboadr
        //     } else {
        //         redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
        //     }
        // }else{
        //     if ($data["token"]!=null ||trim($data["token"])!="") {
        //         redirect(base_url("immobile")); // redirecting to http://www.example.com/admin/dashboadr
        //     } else {
        //         redirect(base_url('immobile/logout')); // then calling the logout url. http//www.example.com/admin/logout
        //     }
        // }
    }

    function im(){
        $data["date"]=date('Y-m-d');
        $data["formatedDate"]=date('l, M j, Y');
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        $resToken=$this->session->userdata("responseToken");

         if($this->session->userdata("session_token")!=null){
             if(!ID_LOGIN) {
                 if ($this->IMUser_Model->isValidToken($resToken)) {
                     $this->load->view('im_view/layout/header',$data);
                     $this->load->view('im_view/mobile/navbar');
                     $this->load->view('im_view/mobile/group', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/mobile/group_footer', $data);
                 } else {
                     redirect(base_url('immobile/logout'));
                 }
             }else{
                 if ($resToken!=null || trim($resToken)!="") {
                     $this->load->view('im_view/layout/header',$data);
                     $this->load->view('im_view/mobile/navbar');
                     $this->load->view('im_view/mobile/group', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/mobile/group_footer', $data);
                 } else {
                     redirect(base_url('immobile/logout'));
                 }
             }
        }else{
             redirect(base_url('immobile/logout'));
        }

    }
    function message(){
        $data["date"]=date('Y-m-d');
        $data["formatedDate"]=date('l, M j, Y');
        $data["var"]=$this->config->item("app_dv_var");
        $resToken=$this->session->userdata("responseToken");

        if($this->session->userdata("session_token")!=null){
            if(!ID_LOGIN) {
                if ($this->IMUser_Model->isValidToken($resToken)) {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/message', $data);
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/message_footer', $data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }else{
                if ($resToken!=null || trim($resToken)!="") {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/message', $data);
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/message_footer', $data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }
        }else{
            redirect(base_url('immobile/logout'));
        }

    }
    function info(){
        $data["date"]=date('Y-m-d');
        $data["var"]=$this->config->item("app_dv_var");
        $data["formatedDate"]=date('l, M j, Y');
        $resToken=$this->session->userdata("responseToken");

        if($this->session->userdata("session_token")!=null){
            if(!ID_LOGIN) {
                if ($this->IMUser_Model->isValidToken($resToken)) {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/info', $data);
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/info_footer', $data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }else{
                if ($resToken!=null || trim($resToken)!="") {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/info', $data);
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/info_footer', $data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }
        }else{
            redirect(base_url('immobile/logout'));
        }

    }

    function profile(){
        $resToken=$this->session->userdata("responseToken");
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null){
            if(!ID_LOGIN) {
                if ($this->IMUser_Model->isValidToken($resToken)) {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/edit_profile');
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/edit_profile_footer_script',$data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }else{
                if ($resToken!=null || trim($resToken)!="") {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/mobile/navbar');
                    $this->load->view('im_view/mobile/edit_profile');
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/mobile/edit_profile_footer_script',$data);
                } else {
                    redirect(base_url('immobile/logout'));
                }
            }
        }
        else{
            redirect(base_url('immobile/logout'));
        }
    }
}