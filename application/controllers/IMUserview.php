<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 12/20/2016
 * Time: 11:29 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class IMUserview extends CI_Controller {


    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        if (!auth_check()) {
			redirect(lang_base_url());
		}

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
                    redirect(base_url("imuserview/im"));
                } else { // if the response token is not valid
                    redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/admin/logout
                }
            } else { // if the session token is null
                redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/admin/logout
            }
        }else{
            if ($this->session->userdata("session_token") != null) {  // checking session token is null or not
                if ($resToken!=null || trim($resToken)!="") {
                    redirect(base_url("imuserview/im"));
                } else { // if the response token is not valid
                    redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/admin/logout
                }
            } else { // if the session token is null
                redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/admin/logout
            }
        }
    }

    function logout(){
        $this->session->set_userdata("session_token",null); // setting the session token to null
        $this->session->set_userdata("responseToken",null);// setting the response token to null
        $this->session->sess_destroy(); // destroying the current session
        redirect(base_url('logout'),'refresh');
    }

    function loginSuccess(){ //http://www.example.com/loginSuccess
        $data["token"]=$this->input->get('r', TRUE); // collecting response token from url query param
        $token=md5(date(DATE_ISO8601, strtotime("now"))); // creating a session token
        $this->session->set_userdata("session_token",$token); // assigning the session to the current session
        $this->session->set_userdata("responseToken",$data["token"]);// assigning the response token to the current session
        $this->session->set_userdata("type","user"); // setting up the user type
        // if(!ID_LOGIN) {
        //     if ($this->IMUser_Model->isValidToken($data["token"])) {
        //         redirect(base_url("imuserview")); // redirecting to http://www.example.com/userview/im
        //     } else {
        //         redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/logout
        //     }
        // }else{
        //     if ($data["token"]!=null ||trim($data["token"])!="") {
        //         redirect(base_url("imuserview")); // redirecting to http://www.example.com/userview/im
        //     } else {
        //         redirect(base_url('imuserview/logout')); // then calling the logout url. http//www.example.com/logout
        //     }
        // }
        $a = array(
            "resToken" => $this->session->userdata("responseToken"),
            'sessToken' => $this->session->userdata("session_token"),
            'ustype' => $this->session->userdata("type"),
        );
        echo json_encode($a);
    }

    function imbak(){
        
        $data["date"]=date('Y-m-d');
        $data["formatedDate"]=date('l, M j, Y');
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        $resToken=$this->session->userdata("responseToken");

         if($this->session->userdata("session_token")!=null){
             if(!ID_LOGIN) {
                 if ($this->IMUser_Model->isValidToken($resToken)) {
                     $this->load->view('im_view/layout/header',$data);
                     //$this->load->view('partials/_header', $data);
                     $this->load->view('im_view/layout/navbar');
                     $this->load->view('im_view/im', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/im_footer', $data);
                 } else {
                    echo "AAAA: ".$this->session->userdata("responseToken");
                     //redirect(base_url('imuserview/logout'));
                 }
             }else{
                 if ($resToken!=null || trim($resToken)!="") {
                     $this->load->view('im_view/layout/header',$data);
                     //$this->load->view('partials/_header', $data);
                     $this->load->view('im_view/layout/navbar');
                     $this->load->view('im_view/im', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/im_footer', $data);
                 } else {
                    echo "BBB: ".$this->session->userdata("responseToken");
                     //redirect(base_url('imuserview/logout'));
                 }
             }
        }else{
            echo "CCC: ".$this->session->userdata("responseToken");
             //redirect(base_url('imuserview/logout'));
        }
      

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
                     $this->load->view('im_view/layout/navbar');
                     $this->load->view('im_view/im', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/im_footer', $data);
                 } else {
                    echo "AAAA: ".$this->session->userdata("responseToken");
                     //redirect(base_url('imuserview/logout'));
                 }
             }else{
                 if ($resToken!=null || trim($resToken)!="") {
                     $this->load->view('im_view/layout/header',$data);
                     $this->load->view('im_view/layout/navbar');
                     $this->load->view('im_view/im', $data);
                     $this->load->view('im_view/layout/header_script',$data);
                     $this->load->view('im_view/im_footer', $data);
                 } else {
                    echo "BBB: ".$this->session->userdata("responseToken");
                     //redirect(base_url('imuserview/logout'));
                 }
             }
        }else{
            echo "CCC: ".$this->session->userdata("responseToken");
             //redirect(base_url('imuserview/logout'));
        }

    }

    function imoto(){
        $data["date"]=date('Y-m-d');
        $data["var"]=$this->config->item("app_dv_var");
        $data["formatedDate"]=date('l, M j, Y');
        $resToken=$this->session->userdata("responseToken");

        if($this->session->userdata("session_token")!=null){
            if($this->IMUser_Model->isValidToken($resToken)) {
                $this->load->view('im_view/oneToOne/header',$data);
                $this->load->view('im_view/layout/navbar');
                $this->load->view('im_view/oneToOne/otoIm', $data);
                $this->load->view('im_view/layout/header_script',$data);
                $this->load->view('im_view/oneToOne/footer', $data);
            }else{
                redirect(base_url('imuserview/logout'));
            }
        }else{
            redirect(base_url('imuserview/logout'));
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
                    $this->load->view('im_view/layout/navbar');
                    $this->load->view('im_view/edit_profile');
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/edit_profile_footer_script',$data);
                } else {
                    redirect(base_url('imuserview/logout'));
                }
            }else{
                if ($resToken!=null || trim($resToken)!="") {
                    $this->load->view('im_view/layout/header',$data);
                    $this->load->view('im_view/layout/navbar');
                    $this->load->view('im_view/edit_profile');
                    $this->load->view('im_view/layout/header_script',$data);
                    $this->load->view('im_view/edit_profile_footer_script',$data);
                } else {
                    redirect(base_url('imuserview/logout'));
                }
            }
        }
        else{
            redirect(base_url('imuserview/logout'));
        }
    }
}