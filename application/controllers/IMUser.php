<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class IMUser extends REST_Controller
{
    private $authToken;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('IMUser_Model');
        $this->load->model('IMFriendList_Model');
        if(!ID_LOGIN) {
            $this->authToken = $this->input->get_request_header("x-auth-token");
            if (isset($this->authToken)) {
                if (!$this->IMUser_Model->isValidToken($this->authToken)) {
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_UNAUTHORIZED,
                            "message" => "Unauthorized"
                        ),
                        "response" => null
                    );
                    $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                    return;
                }
            } else {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_UNAUTHORIZED,
                        "message" => "Unauthorized"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
        }

    }

    public function changePassword_post()
    {
        if(!ID_LOGIN) {

            $id = $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $id=$this->post("userId");
        }

        $this->form_validation->set_rules('userPassword', 'Old Password', 'required');
        $this->form_validation->set_rules('newPassword', 'New Password', 'required');

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
            if (!$this->IMUser_Model->userExist($id)) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "User Not Found"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);

            } else {
                if ($this->IMUser_Model->checkUserPassword($id, $this->post('userPassword'))) {
                    $user = $this->IMUser_Model->update_password($id,$this->post('newPassword'));


                    //$value = $this->jwt->decode($user, $CONSUMER_SECRET);
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_OK,
                            "message" => "Success"
                        ),
                        "response" => $user
                    );
                    $this->response($response, REST_Controller::HTTP_OK);
                } else {

                    //$value = $this->jwt->decode($user, $CONSUMER_SECRET);
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_NOT_FOUND,
                            "message" => "Old Password is not correct"
                        ),
                        "response" => null
                    );
                    $this->response($response, REST_Controller::HTTP_NOT_FOUND);
                }

            }


        }
    }
    public function friendList_get()
    {
        if(!ID_LOGIN) {

            $userId =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $userId=$this->get("userId");
        }
        $start=$this->get("start");
        $limit=$this->get("limit",true);
        // ------------------- Section 1 starts----------------//
        /*$friendIds = $this->IMFriendList_Model->getList($userId,$limit,$start);           // if you want friend list design uncomment
                                                                              // this section and comment out section 2
        $friends = array();
        foreach ($friendIds as $friendId) {
            $friends[] = $this->IMUser_Model->get_Active_user($friendId->friendId, null,null);
        }
        $responseData=array(
            "friends"=> $friends,
            "total"=>(int)$this->IMFriendList_Model->getTotalFriend($userId)
        );*/
        //------------------ section 1 ends ----------------//
        //------------------section 2 starts ---------------//
            $friends=$this->IMUser_Model->getAllActiveUser($userId,$limit,$start);
        $responseData=array(
            "friends"=> $friends,
            "total"=>(int)$this->IMUser_Model->getTotalUser(),
        );
        //------------------ section 2 ends ----------------//

        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => true
            ),
            "response" => $responseData
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function filterFriendList_get(){
        if(!ID_LOGIN) {

            $userId =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $userId=$this->get("userId");
        }
        $key=$this->get("key",true);

        /*$friendsIds=$this->IMFriendList_Model->getFriendsIdAsArray($userId); //only for friend LIST
        $friends=$this->IMUser_Model->filterUser($friendsIds,$key);*/

        // for all user

        $friends=$this->IMUser_Model->filterAllUser($userId,$key);
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => true
            ),
            "response" => $friends
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function friendAdd_post()
    {
        if(!ID_LOGIN) {

            $userId =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $userId=$this->post("userId");
        }
        $this->form_validation->set_rules('friendId', 'friendId', 'required');
        $friendId = $this->post("friendId");
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
            if (!$this->IMFriendList_Model->friendExist($userId, $friendId) && !$this->IMFriendList_Model->friendExist($friendId, $userId) && (int)$userId != (int)$friendId) {
                $this->IMFriendList_Model->insert($userId, $friendId);
                $this->IMFriendList_Model->insert($friendId, $userId);
            }
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_OK,
                    "message" => "friend added successfully"
                ),
                "response" => true
            );
            $this->response($response, REST_Controller::HTTP_OK);

        }
    }
    public function userProfile_get()
    {
        if(!ID_LOGIN) {

            $id =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $id=$this->get("userId");
        }
        $users = $this->IMUser_Model->get_user($id,$this->get('start'),$this->get('limit'));
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => $users
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function edit_post(){
        if(!ID_LOGIN) {

            $id =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $id=$this->post("userId");
        }
        $this->form_validation->set_rules('firstName', 'First Name', 'required');
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
            if (!$this->IMUser_Model->userExist($id)) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "User Not Found"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);

            } else {
                $user = $this->IMUser_Model->update_entry($id,$this->post('firstName'),$this->post('lastName'),$this->post('userMobile'),$this->post('userAddress'),$this->post('userGender'),$this->post('userDateOfBirth'));
                if(!ID_LOGIN){
                    $token = $this->IMUser_Model->getTokenById($id);
                    $type="token";
                }else{
                    $token=$this->IMUser_Model->getTokenRAWDataById($id);
                    $type="raw";
                }

                //$value = $this->jwt->decode($user, $CONSUMER_SECRET);
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_OK,
                        "message" => "Success"
                    ),
                    "response" => $user,
                    "token"=>$token,
                    "type"=>$type
                );
                $this->response($response, REST_Controller::HTTP_OK);

            }
        }


    }

    public function profilePictureUpload_post()
    {
        if(!ID_LOGIN) {

            $id =(int) $this->IMUser_Model->getTokenToId($this->authToken);
        }else{
            $id=$this->post("userId");
        }

        $userProfilePicture = null;
        if (!$this->IMUser_Model->userExist($id)) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_FOUND,
                    "message" => "User Not Found"
                ),
                "response" => null
            );
            $this->response($response, REST_Controller::HTTP_NOT_FOUND);

        } else {
            //$users = $this->IMUser_Model->get_user($this->post('userId'),null,null);
            $date = date("mjYGis");
            //image uploading section
            $config['upload_path'] = './assets/im/userImage/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $date . "profile" . $id;
            $config['max_size'] = '5120';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "Image upload Error"
                    ),
                    "response" => $this->upload->display_errors()
                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);

            } else {
                //here $file_data receives an array that has all the info
                //pertaining to the upload, including 'file_name'
                $file_data = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_data['full_path']; //get original image
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 600;
                $config['quality']='100%';
                $this->load->library('image_lib', $config);
                if (!$this->image_lib->resize()) {
                    $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_BAD_REQUEST,
                            "message" => "File upload Error"
                        ),
                        "response" => $this->image_lib->display_errors()
                    );
                    $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
                }


                $userProfilePicture = $file_data['file_name'];
                $user = $this->IMUser_Model->update_picture($id, $userProfilePicture);
                if(!ID_LOGIN){
                    $token = $this->IMUser_Model->getTokenById($id);
                    $type="token";
                }else{
                    $token=$this->IMUser_Model->getTokenRAWDataById($id);
                    $type="raw";
                }
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_OK,
                        "message" => "Success"
                    ),
                    "response" => $user,
                    "token"=>$token,
                    "type"=>$type
                );
                $this->response($response, REST_Controller::HTTP_OK);
            }

        }

    }
}