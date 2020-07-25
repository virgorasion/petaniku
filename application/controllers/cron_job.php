<?php
class Cron_job extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ftp');
        $this->load->model('cron_model');
        ini_set('memory_limit', '3000M');
        set_time_limit(0); 
    }

    function index()
    {
        if ($this->input->is_cli_request())
        {
            $this->check_transactions();
            // $this->check_orders();
        }
    }

    public function check_transactions()
    {
        $ftpServer = "server";
        $ftpUser = "username";
        $ftpPassword = "password";

        $ftp_server = $ftpServer;
        $ftp_conn = ftp_connect($ftp_server);
        $ftp_login = ftp_login($ftp_conn, $ftpUser, $ftpPassword ); 

        if(!$ftp_conn) 
            die("A connection to $ftpServer couldn't be established"); 
        else if(!$ftp_login) 
            die("Your login credentials were rejected"); 
        else
        {
           $get_transactions = $this->cron_model->get_transactions();
        //    foreach($get_transactions as $data){
        //        $check = 
        //    }
        }
    }
}
