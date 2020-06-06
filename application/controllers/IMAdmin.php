<?php

class IMAdmin extends CI_Controller{   // administrator controller

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
        $this->load->model('IMUser_Model');
        $this->load->model("IMAdmin_Model");
        if($this->load->is_loaded("CI_Minifier")){
            $this->ci_minifier->enable_obfuscator(3);
        }

    }

    public function index() // http://www.example.com/admin
    {
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null){// checking session token is null or not
            if($this->session->userdata("type")=="admin"){ // checking user is a admin or not
                $resToken=$this->session->userdata("responseToken"); // collecting response token from session
                if($resToken!=null && $this->IMUser_Model->isValidToken($resToken)){ // checking response token is valid or not
                    redirect(base_url("imadmin/loginSuccess")."?r=".$resToken); //redirecting to http://www.example.com/admin/loginSuccess with the response token
                }
                else{
                    $this->load->view('im_view/layout/admin_header',$data);
                    $this->load->view('im_view/admin_view/admin_login',$data); // loading admin login view
                }
            }else{
                redirect(base_url('imadmin/logout')); // redirecting to http://www.example.com/admin/logout
            }
        }
        else{
            $this->load->view('im_view/layout/admin_header',$data);
            $this->load->view('im_view/admin_view/admin_login',$data); // loading admin login view
        }

    }

    function loginSuccess(){ //http://www.example.com/admin/loginSuccess
        $data["token"]=$this->input->get('r', TRUE); // collecting response token from url query param
        $token=md5(date(DATE_ISO8601, strtotime("now"))); // creating a session token
        $this->session->set_userdata("session_token",$token); // assigning the session to the current session
        $this->session->set_userdata("responseToken",$data["token"]);// assigning the response token to the current session
        $this->session->set_userdata("type","admin"); // setting up the user type
        if($this->IMUser_Model->isValidToken($data["token"])) {
            redirect(base_url("imadmin/dashboard")); // redirecting to http://www.example.com/admin/dashboadr
        }else{
            redirect(base_url('imadmin/logout')); // then calling the logout url. http//www.example.com/admin/logout
        }
    }

   function dashboard(){  // http://www.example.com/admin/dashboadr
       $resToken=$this->session->userdata("responseToken");  // obtaining a response token from the session
       $data["var"]=$this->config->item("app_dv_var");
       if($this->session->userdata("session_token")!=null) {  // checking session token is null or not
           if($this->IMUser_Model->isValidToken($resToken)){        // if session token is not null then checking the response token is valid or not
               $userId=$this->IMUser_Model->getTokenToId($resToken);// obtaining the user id using the response token
               $view=true; // if the admin is superuser or 0 then view is true
               $adminType=(int)$this->IMAdmin_Model->getAdminType($userId); //getting the admin type from database
               if($adminType==1){ //if the admin type is not 0 or 1
                   $view=false;  // admin is not a superuser. his role is a manager
               }

               $data['totalUser']=$this->IMAdmin_Model->getTotalUser(); // getting the total number of users from the database
               $data['totalActiveUser']=$this->IMAdmin_Model->getToatalActiveUser(); // getting the total number of active users from the database
               //$data['totalActiveUser']=rand(5,100);
               $data["totalMessage"]=$this->IMAdmin_Model->getTotalMessage(); // getting the total number of messages from the database
               $data["totalGroups"]=$this->IMAdmin_Model->getTotalGroup();// getting the total number of groups from the database
               $data["chart"]=$this->IMAdmin_Model->getMonthelyMessage(date("Y")); // getting total messages monthly in this current year
               $data['view']=$view; // setting up the $view value
               $this->load->view("im_view/layout/admin_header",$data); // loading application/views/layout/admin_header.php
               $this->load->view("im_view/admin_view/common/navbar",$data);// loading application/views/admin_view/common/navbar.php and passing the $data variable to this view
               $this->load->view("im_view/admin_view/dashboard",$data);// loading application/views/admin_view/dashboard.php and passing the $data variable to this view
           }
           else{ // if the response token is not valid
               redirect(base_url('imadmin/logout')); // then calling the logout url. http//www.example.com/admin/logout
           }
       }else{ // if the session token is null
           redirect(base_url('imadmin/logout')); // then calling the logout url. http//www.example.com/admin/logout
       }
   }

    function logout(){ // http//www.example.com/admin/logout
        $this->session->set_userdata("session_token",null); // setting the session token to null
        $this->session->set_userdata("responseToken",null);// setting the response token to null
        $this->session->sess_destroy(); // destroying the current session
        redirect(base_url('imadmin')); //redirecting to login page http://www.example.com/admin
    }

    function user($page=1){ // http//www.example.com/admin/user
        $resToken=$this->session->userdata("responseToken"); // obtaining a response token from the session
        $filterData=trim($this->input->get('search',TRUE)); // obtaining the search value from the query param .exp: http//www.example.com/admin/user?search=john
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null) { // checking session token is null or not
            if($this->IMUser_Model->isValidToken($resToken)){ // if session token is not null then checking the response token is valid or not
                $userId=$this->IMUser_Model->getTokenToId($resToken); //obtaining user id from response token
                $view=true; // if the admin is superuser or 0 then view is true
                $adminType=(int)$this->IMAdmin_Model->getAdminType($userId); //getting the admin type from database
                if($adminType==1){ //if the admin type is not 0 or 1
                    $view=false; // admin is not a superuser. his role is a manager
                }
                $data['view']=$view; // setting up the $view value
                if($filterData!=null || $filterData!=''){ //if the search variable is not empty

                    if(!filter_var($filterData, FILTER_VALIDATE_EMAIL) === false) { // if the search variable contains an email address
                        $user = $this->IMAdmin_Model->getUserByEmail($filterData); //then get the user data using that email address
                        $users=array();
                        if($user!=null){
                            $users[]=$user;
                        }
                    }else{  // if search variable contains a name then finding user data using that name
                        $fullName=explode(' ',$filterData);
                        if(count($fullName)>1){
                            $users=$this->IMAdmin_Model->getUserByName($fullName[0],$fullName[1]);
                        }else{
                            $users=$this->IMAdmin_Model->getUserByName($fullName[0],null);
                        }

                    }

                    $data["userList"]=$users;
                    $data['links']=null;
                    $this->load->view("im_view/layout/admin_header",$data);
                    $this->load->view("im_view/admin_view/common/navbar",$data);
                    $this->load->view("im_view/admin_view/userList",$data);
                    //$this->load->view("im_view/admin_view/empty",$data);
                }else{
                    $this->load->library('pagination');
                    $config=$this->initPagination(base_url('imadmin/user'),$this->IMAdmin_Model->getTotalUser());
                    $this->pagination->initialize($config);
                    $data["pagination_helper"]= $this->pagination;
                    $data["userList"]=$this->IMAdmin_Model->getUserList($config['per_page'],(($page-1) * $config['per_page']));
                    $data['links']=$this->pagination->create_links();
                    $this->load->view("im_view/layout/admin_header",$data);
                    $this->load->view("im_view/admin_view/common/navbar",$data);
                    //$this->load->view("admin_view/empty",$data);
                    $this->load->view("im_view/admin_view/userList",$data);
                }
            }
            else{
                redirect(base_url('imadmin/logout')); // redirecting to http://www.example.com/admin/logout
            }
        }else{
            redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
        }

    }

    function messengerOptions($page=1){
        $resToken=$this->session->userdata("responseToken");// collecting response token from session
        $filterData=trim($this->input->get('search',TRUE));
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null) {// checking session token is null or not
            if($this->IMUser_Model->isValidToken($resToken)){ // if session token is not null then checking the response token is valid or not
                $userId=$this->IMUser_Model->getTokenToId($resToken);
                $view=true;
                $adminType=(int)$this->IMAdmin_Model->getAdminType($userId);
                if($adminType==1){
                    $view=false;
                }
                $data['view']=$view;
                if($filterData!=null || $filterData!=''){

                    if(!filter_var($filterData, FILTER_VALIDATE_EMAIL) === false) {
                        $user = $this->IMAdmin_Model->getUserByEmail($filterData);
                        $users=array();
                        if($user!=null){
                            $users[]=$user;
                        }
                    }else{
                        $fullName=explode(' ',$filterData);
                        if(count($fullName)>1){
                            $users=$this->IMAdmin_Model->getUserByName($fullName[0],$fullName[1]);
                        }else{
                            $users=$this->IMAdmin_Model->getUserByName($fullName[0],null);
                        }

                    }

                    $data["userList"]=$users;
                    $data['links']=null;
                    $this->load->view("im_view/layout/admin_header",$data);
                    $this->load->view("im_view/admin_view/common/navbar",$data);
                    $this->load->view("im_view/admin_view/messengerOptions",$data);
                    //$this->load->view("im_view/admin_view/empty",$data);
                }else{
                    $this->load->library('pagination');
                    $config=$this->initPagination(base_url('imadmin/messengerOptions'),$this->IMAdmin_Model->getTotalUser());
                    $this->pagination->initialize($config);
                    $data["pagination_helper"]= $this->pagination;
                    $data["userList"]=$this->IMAdmin_Model->getUserList($config['per_page'],(($page-1) * $config['per_page']));
                    $data['links']=$this->pagination->create_links();
                    $this->load->view("im_view/layout/admin_header",$data);
                    $this->load->view("im_view/admin_view/common/navbar",$data);
                    //$this->load->view("im_view/admin_view/empty",$data);
                    $this->load->view("im_view/admin_view/messengerOptions",$data);
                }
            }
            else{
                redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
            }
        }else{
            redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
        }

    }

    public function adminsettings($page=1){
        $resToken=$this->session->userdata("responseToken");// collecting response token from session
        $filterEmail=trim($this->input->get('search',TRUE));
        $data["demo"]=DEMO;
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null) {// checking session token is null or not
            if($this->IMUser_Model->isValidToken($resToken)){// if session token is not null then checking the response token is valid or not
                $userId=$this->IMUser_Model->getTokenToId($resToken);
                $view=true;
                $adminType=(int)$this->IMAdmin_Model->getAdminType($userId);
                if($adminType==1){
                    $view=false;
                }
                $data['view']=$view;
                if($filterEmail!=null || $filterEmail!=''){

                    if(!filter_var($filterEmail, FILTER_VALIDATE_EMAIL) === false) {
                        $users = $this->IMAdmin_Model->getAdminByEmail($filterEmail);
                    }else{
                        $users=$this->IMAdmin_Model->getAdminByName($filterEmail);
                    }

                    $data["userList"]=$users;
                    $data['links']=null;

                $this->load->view("im_view/layout/admin_header",$data);
                $this->load->view("im_view/admin_view/common/navbar",$data);
                $this->load->view("im_view/admin_view/admin_settings",$data);
                }else{
                    $this->load->library('pagination');
                    $config=$this->initPagination(base_url('imadmin/adminSettings'),(int)$this->IMAdmin_Model->getTotalAdmin());
                    $this->pagination->initialize($config);
                    $data["pagination_helper"]= $this->pagination;
                    $data["userList"]=$this->IMAdmin_Model->getAllAdmin($config['per_page'],(($page-1) * $config['per_page']));
                    $data['links']=$this->pagination->create_links();
                    $this->load->view("im_view/layout/admin_header",$data);
                    $this->load->view("im_view/admin_view/common/navbar",$data);
                    $this->load->view("im_view/admin_view/admin_settings",$data);
                }
            }
            else{
                redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
            }
        }else{
            redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
        }
    }

    public function messenger($userID){
        $resToken=$this->session->userdata("responseToken");// collecting response token from session
        $data["var"]=$this->config->item("app_dv_var");
        if($this->session->userdata("session_token")!=null) {// checking session token is null or not
            if ($this->IMUser_Model->isValidToken($resToken)) { // if session token is not null then checking the response token is valid or not
                if(ID_LOGIN){
                    $data["_r"]= json_encode($this->IMUser_Model->getTokenRAWDataById($userID));
                    $data["T"]="RAW";
                }else{
                    $data["_r"]=$this->IMUser_Model->getTokenById($userID);
                    $data["T"]="token";
                }

                $this->load->view("im_view/layout/header_messenger",$data);
                $this->load->view("im_view/layout/navbar_empty_messenger",$data);
                $this->load->view("im_view/admin_view/messenger",$data);

            }
            else{
                    redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
                }
            }else{
                redirect(base_url('imadmin/logout'));// redirecting to http://www.example.com/admin/logout
            }
    }

    private function initPagination($base_url,$total_rows){
        $config['per_page']          = 20;
        $config['uri_segment']       = 3;
        $config['base_url']          = $base_url;
        $config['total_rows']        = $total_rows;
        $config['use_page_numbers']  = TRUE;
       // $config['page_query_string'] = TRUE;

        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li class="page-item page-link">';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='paginate_button page-item active'><a href=\"javascript:;\" class='page-link'>";
        $config['cur_tag_close'] = "</a></li>";
       // $this->ci->pagination->initialize($config);
        return $config;
    }

    /*public  function support(){
        $resToken=$this->session->userdata("responseToken");// collecting response token from session
        if($this->session->userdata("session_token")!=null) {// checking session token is null or not
            if ($this->User_Model->isValidToken($resToken)) {// if session token is not null then checking the response token is valid or not
                $userId=$this->User_Model->getTokenToId($resToken);
                $view=true;
                $adminType=(int)$this->Admin_Model->getAdminType($userId);
                if($adminType==1){
                    $view=false;
                }
                $data['view']=$view;
                $data["supportInfo"]=$this->Admin_Model->getContactInfo();
                $this->load->view("im_view/layout/admin_header");
                $this->load->view("im_view/admin_view/common/navbar",$data);
                $this->load->view("im_view/admin_view/user_supportInfo",$data);
            }else{
                    redirect(base_url('admin/logout'));// redirecting to http://www.example.com/admin/logout
                }
            }else{
                redirect(base_url('admin/logout'));// redirecting to http://www.example.com/admin/logout
            }
    }*/

}