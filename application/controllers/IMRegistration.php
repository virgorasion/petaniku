<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class IMRegistration extends REST_Controller
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('IMUser_Model');
    }


    public function register_post()
    {
        $this->form_validation->set_rules('userEmail', 'userEmail', 'required|valid_email');
        $this->form_validation->set_rules('firstName', 'firstName', 'required');
        $this->form_validation->set_rules('userPassword', 'userPassword', 'required');
        $this->form_validation->set_rules('userType', 'userType', 'required');

        if($this->post('userType')== 2){
            $this->form_validation->set_rules('userAddress', 'userAddress', 'required');
            $this->form_validation->set_rules('userMobile', 'userMobile', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $CONSUMER_KEY = $this->IMUser_Model->generateRandomString();
            $CONSUMER_SECRET = $this->config->item("CONSUMER_SECRET");

            $CONSUMER_TTL = 86400;
            if ($this->IMUser_Model->ifExist($this->post('userEmail',true))) {
                if ($this->IMUser_Model->ifInvited($this->post('userEmail',true))) {
                    $id = $this->IMUser_Model->getUserId($this->post('userEmail',true));
                    $this->IMUser_Model->update_entry($id,$this->post('firstName',true),$this->post('lastName',true),$this->post('userMobile',true),$this->post('userAddress',true),null,null);
                    $this->IMUser_Model->update_type($id,$this->post('userType',true));
                    $this->IMUser_Model->update_password($id,$this->post('userPassword',true));
                    $this->IMUser_Model->activate_entry($this->post('userEmail',true));
                    $this->IMUser_Model->update_token($id,$CONSUMER_KEY);

                    if(!ID_LOGIN){
                        $token = $this->IMUser_Model->getToken($this->post('userEmail',true));
                        $type="token";
                    }else{
                        $token=$this->IMUser_Model->getTokenRAWData($this->post('userEmail',true));
                        $type="raw";
                    }

                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_OK,
                            "message" => "User Registered successfully!"
                        ),
                        "response" => $token,
                        "type"=>$type
                    );
                    $this->response($response, REST_Controller::HTTP_OK);

                } else {
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_CONFLICT,
                            "message" => "Email already exist!"
                        ),
                        "response" => null
                    );
                $this->response($response, REST_Controller::HTTP_CONFLICT);
            }
            } else {
                $this->IMUser_Model->insert_entry($CONSUMER_KEY, $this->post('firstName'), $this->post('lastName'), $this->post('userEmail'), $this->post('userPassword'), $this->post('userAddress'), $this->post('userMobile'), $this->post('userType'), 0);

                if(!ID_LOGIN){
                    $token = $this->IMUser_Model->getToken($this->post('userEmail'));
                    $type="token";
                }else{
                    $token=$this->IMUser_Model->getTokenRAWData($this->post('userEmail'));
                    $type="raw";
                }


                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_OK,
                        "message" => "User is successfully registered "
                    ),
                    "response" => $token,
                    "type"=>$type
                );

                $this->response($response, REST_Controller::HTTP_OK);
            }
        }
    }


    public function login_post()
    {
        //$this->load->view('welcome');
        $this->form_validation->set_rules('userEmail', 'email', 'required');
        $this->form_validation->set_rules('userPassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            if ($this->IMUser_Model->ifExist($this->post('userEmail',true))) {
                if ($this->IMUser_Model->checkUser($this->post('userEmail',true), $this->post('userPassword',true))) {
                    if($this->IMUser_Model->adminBlock($this->post('userEmail',true))) {
                        if ($this->IMUser_Model->checkVerification($this->post('userEmail',true))) {
                            $this->IMUser_Model->activate_entry($this->post('userEmail',true));

                            if(!ID_LOGIN){
                                $token = $this->IMUser_Model->getToken($this->post('userEmail',true));
                                $type="token";
                            }else{
                                $token=$this->IMUser_Model->getTokenRAWData($this->post('userEmail',true));
                                $type="raw";
                            }

                            $response = array(
                                "status" => array(
                                    "code" => REST_Controller::HTTP_OK,
                                    "message" => "Success"
                                ),
                                "response" => $token,
                                "type"=>$type
                            );
                            $this->response($response, REST_Controller::HTTP_OK);
                        } else {
                            $response = array(
                                "status" => array(
                                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                                    "message" => "Email is not verified"
                                ),
                                "response" => 0
                            );
                            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);

                        }
                    }else{
                        $response = array(
                            "status" => array(
                                "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                                "message" => "Account is BLOCKED by Administrator"
                            ),
                            "response" => 0
                        );
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                    }
                } else {

                    //$value = $this->jwt->decode($user, $CONSUMER_SECRET);
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                            "message" => "Email or Password did not matched"
                        ),
                        "response" => null
                    );
                    $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            } else {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "Email is incorrect"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function adminLogin_post()
    {
        //$this->load->view('welcome');
        $this->form_validation->set_rules('userEmail', 'email', 'required');
        $this->form_validation->set_rules('userPassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            if ($this->IMUser_Model->ifExist($this->post('userEmail',true))) {
                if ($this->IMUser_Model->checkUser($this->post('userEmail',true), $this->post('userPassword',true))) {
                    if($this->IMUser_Model->adminBlock($this->post('userEmail',true))) {
                        if ($this->IMUser_Model->checkVerification($this->post('userEmail',true))) {
                            $this->IMUser_Model->activate_entry($this->post('userEmail',true));

                                $token = $this->IMUser_Model->getTokenAdmin($this->post('userEmail',true));
                                $type="token";

                            $response = array(
                                "status" => array(
                                    "code" => REST_Controller::HTTP_OK,
                                    "message" => "Success"
                                ),
                                "response" => $token,
                                "type"=>$type
                            );
                            $this->response($response, REST_Controller::HTTP_OK);
                        } else {
                            $response = array(
                                "status" => array(
                                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                                    "message" => "Email is not verified"
                                ),
                                "response" => 0
                            );
                            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);

                        }
                    }else{
                        $response = array(
                            "status" => array(
                                "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                                "message" => "Account is BLOCKED by Administrator"
                            ),
                            "response" => 0
                        );
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                    }
                } else {

                    //$value = $this->jwt->decode($user, $CONSUMER_SECRET);
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                            "message" => "Email or Password did not matched"
                        ),
                        "response" => null
                    );
                    $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            } else {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "Email is incorrect"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function create_jwt_token_post()
    {
        try{
            $post_data=json_encode($this->post());
            $dataArray=json_decode($post_data,true);
            $token=$this->IMUser_Model->createTokenfromData($dataArray);
            $this->response($token, REST_Controller::HTTP_OK);
        }catch(Exception $e){
             $this->response(null, REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

}