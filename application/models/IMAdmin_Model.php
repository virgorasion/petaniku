<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 3/14/2017
 * Time: 8:26 PM
 */

class IMAdmin_Model extends CI_Model{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        //$this->load->library('encrypt');

    }

    public function getTotalUser(){
        $this->db->select("*");
        //$this->db->from("users");
        $this->db->where("userType=",1);
        return $this->db->get("im_users")->num_rows();

    }

    public function getToatalActiveUser(){
        $this->db->select("userId");
        $this->db->group_by("userId");
        return $this->db->get("im_usersocket")->num_rows();
    }

    public function getTotalGroup(){
        $this->db->select("g_id");
        return (int)$this->db->get("im_group")->num_rows();
    }

    public function getTotalMessage(){
        $this->db->select("m_id");
        return (int)$this->db->get("im_message")->num_rows();
    }

    public function getMonthelyMessage($year){
        $messageData=array();
            $this->db->select("COUNT(m_id) as total, MONTH(date_time) as month");
            if ($year == null) {
                $this->db->where("YEAR(date_time)=", date("Y"));
            } else {
                $this->db->where("YEAR(date_time)=", $year);
            }
            $this->db->group_by("MONTH(date_time)");
            $this->db->order_by("MONTH(date_time)");
            $query = $this->db->get("im_message");
            for ($i = 1; $i <= 12; $i++) {
                $messageData[$i] = array(
                    "month" => $i,
                    "total" => 0
                );
            }
            if($query->num_rows()!==0){
                foreach ($query->result() as $data) {
                    $messageData[(int)$data->month] = array(
                        "month" => (int)$data->month,
                        "total" => (int)$data->total
                    );
                }
            }


        return $messageData;
    }

    public function getTotalAdmin(){
        $this->db->select("userId");
        //$this->db->from("users");
        $this->db->where("userType=",0);
        return (int)$this->db->get("im_users")->num_rows();

    }

    public function getUserProfileLastUpdate($userId){
        $this->db->select("lastModified");
        $this->db->where("userId=",$userId);
        return $this->db->get("im_users")->row()->lastModified;
    }
    public function getTotalGroupByUserId($u_id){
        $this->db->select("g_id");
        $this->db->where("createdBy=",$u_id);
        return (int)$this->db->get("im_group")->num_rows();
    }
    function getUserList($limit,$start){
        $this->db->select("*");
        $this->db->where("userType=",1);
        $this->db->order_by('userId');
        $query = $this->db->get('im_users', $limit, $start);
        $users=$query->result();
        $profiles=array();
        foreach ($users as $user){
            if($user->userProfilePicture!=null){
                $url = base_url()."assets/im/userImage/".$user->userProfilePicture;
            }
            else{
                $url = base_url()."assets/im/img/download.png";
            }

            $profiles[] = array(
                'userId' =>(int)$user->userId,
                'firstName' =>$user->firstName,
                'lastName'=>$user->lastName,
                'userEmail'=>$user->userEmail,
                'userAddress'=>$user->userAddress,
                'userMobile'=>$user->userMobile,
                'userStatus'=>(int) $user->userStatus,
                'userGender'=>$user->userGender,
                'userVerification'=>(int)$user->userVerification,
                'profilePictureUrl' => $url

            );
        }
        return $profiles;
        //return $query->result();
    }

    function getUserByEmail($email){
        $this->db->select("*");
        $this->db->where("userType=",1);
        $this->db->where("userEmail=",$email);
        $query = $this->db->get('im_users');
        $user=$query->row();
            if($user!=null) {

                if ($user->userProfilePicture != null) {
                    $url = base_url() . "assets/im/userImage/" . $user->userProfilePicture;
                } else {
                    $url = base_url() . "assets/im/img/download.png";
                }

                $profile = array(
                    'userId' => (int)$user->userId,
                    'firstName' => $user->firstName,
                    'lastName' => $user->lastName,
                    'userEmail' => $user->userEmail,
                    'userAddress' => $user->userAddress,
                    'userMobile' => $user->userMobile,
                    'userStatus' => (int)$user->userStatus,
                    'userGender' => $user->userGender,
                    'userVerification' => (int)$user->userVerification,
                    'profilePictureUrl' => $url

                );

                return $profile;
            }else{
                return null;
            }
        //return $query->result();
    }

    function getUserByName($fName,$lName){
        $this->db->select("*");
        $this->db->where("userType=",1);
        $this->db->like("firstName",$fName);
        if($lName!=null || $lName!=''){

            $this->db->like("lastName",$lName);
        }
        $query = $this->db->get('im_users');
        $profile=array();
        $users=$query->result();
        if($users!=null) {
            foreach ($users as $user) {
                if ($user->userProfilePicture != null) {
                    $url = base_url() . "assets/im/userImage/" . $user->userProfilePicture;
                } else {
                    $url = base_url() . "assets/im/img/download.png";
                }

                $profile[] = array(
                    'userId' => (int)$user->userId,
                    'firstName' => $user->firstName,
                    'lastName' => $user->lastName,
                    'userEmail' => $user->userEmail,
                    'userAddress' => $user->userAddress,
                    'userMobile' => $user->userMobile,
                    'userStatus' => (int)$user->userStatus,
                    'userGender' => $user->userGender,
                    'userVerification' => (int)$user->userVerification,
                    'profilePictureUrl' => $url

                );
            }
            return $profile;
        }else{
            return null;
        }
        //return $query->result();
    }


    public function getAllAdmin($limit,$start){
        $this->db->select('u.userId, u.firstName,u.userEmail,at.adminType');
        $this->db->join('im_admintype at','at.adminId=u.userId','INNER');
        $this->db->where('u.userType=',0);
        $this->db->where_in("at.adminType",array(0,1,2));
        $query=$this->db->get("im_users u",$limit,$start);
        $profiles=array();
        $users=$query->result();
        foreach ($users as $user){
            $profiles[] = array(
                'userId' =>(int)$user->userId,
                'firstName' =>$user->firstName,
                'userEmail'=>$user->userEmail,
                'adminType'=>$user->adminType
            );
        }
        return $profiles;
    }

    public function deactivateUser($userId){
        $data=array(
            'userVerification'=>0,
            'userStatus'=>0
        );
        $this->db->where('userId=',$userId);
        $this->db->update('im_users',$data);

    }
    public function activateUser($userId){
        $data=array(
            'userVerification'=>1,
            'userStatus'=>1
        );
        $this->db->where('userId=',$userId);
        $this->db->update('im_users',$data);
    }

    public function getAdminType($userId){
        $this->db->select('adminType');
        $this->db->where('adminId',$userId);
        //$this->db->where_in('adminType',array(0,1));
        $query=$this->db->get('im_admintype');
        return $query->row()->adminType;
    }

    public function searchUserEmail($email){
        $this->db->select('userEmail,firstName,lastName');
        $this->db->like('userEmail',$email);
        $this->db->where("userType=",1);
        $query=$this->db->get('im_users');
        return $query->result();
    }


    public function blockUser($userId){
        $data=array(
            "userStatus"=>0,
            "userVerification"=>0
        );
        $this->db->where("userId",$userId);
        $this->db->update('im_users',$data);
    }
    public function unblockUser($userId){
        $data=array(
            "userStatus"=>1,
            "userVerification"=>1
        );
        $this->db->where("userId",$userId);
        $this->db->update('im_users',$data);
    }
    public function verifyUser($userId){
        $data=array(
            "userStatus"=>1,
            "userVerification"=>1
        );
        $this->db->where("userId",$userId);
        $this->db->update('im_users',$data);
    }


    function getAdminByEmail($email){
        $this->db->select("*");
        $this->db->where("userType=",0);
        $this->db->like("userEmail",$email);
        $query = $this->db->get('im_users');
        $users=$query->result();
        $profiles=array();
            foreach ($users as $user) {
                $adminType = $this->getAdminType($user->userId);
                $profiles[] = array(
                    'userId' => (int)$user->userId,
                    'firstName' => $user->firstName,
                    'userEmail' => $user->userEmail,
                    'adminType' => (int)$adminType
                );
            }
            return $profiles;
        //return $query->result();
    }

    function getAdminById($userId){
        $this->db->select("*");
        $this->db->where("userType=",0);
        $this->db->where("userId=",$userId);
        $query = $this->db->get('im_users');
        $user=$query->row();
        if($user!=null) {
            $adminType=$this->getAdminType($user->userId);
            $profile = array(
                'userId' => (int)$user->userId,
                'firstName' => $user->firstName,
                'userEmail' => $user->userEmail,
                'adminType'=>(int)$adminType
            );

            return $profile;
        }else{
            return null;
        }
        //return $query->result();
    }


    function getAdminByName($name){
        $this->db->select("*");
        $this->db->where("userType=",0);
        $this->db->like("firstName",$name);
        $query = $this->db->get('im_users');
        $users=$query->result();
        $profiles=array();

            foreach ($users as $user) {
                $adminType = $this->getAdminType($user->userId);
                $profiles[] = array(
                    'userId' => (int)$user->userId,
                    'firstName' => $user->firstName,
                    'userEmail' => $user->userEmail,
                    'adminType' => (int)$adminType
                );
            }
            return $profiles;
        //return $query->result();
    }


    public function createAdmin($clientSecret, $firstName,$userEmail, $userPassword,$role)
    {
        if ($userPassword == null) {
            $changedPassword = null;
        } else {
            $changedPassword = password_hash($userPassword, PASSWORD_BCRYPT);
        }
        $dataUser = array(
            'userSecret' => $clientSecret,
            'firstName' => $firstName,
            'userEmail' => $userEmail,
            'userPassword' => $changedPassword,
            'userType' => 0,
            'userStatus' => 1,
            'userVerification' => 1,
            'lastModified' => date('Y-m-d G:i:s')

        );
        $this->db->insert("im_users", $dataUser);
        $adminId = $this->db->insert_id();

        $dataRole = array(
            'adminId' => $adminId,
            'adminType' => $role
        );
        $this->db->insert('im_admintype', $dataRole);
    }

    public function deleteAdmin($adminId){
        $this->db->where('userId',$adminId);
        $this->db->delete('im_users');
        $this->db->where('adminId',$adminId);
        $this->db->delete('im_admintype');
    }
    public function updateAdmin($adminId,$firstName,$userEmail, $userPassword,$role){
        if ($userPassword == null) {
            $dataUser = array(
                'firstName' => $firstName,
                'userEmail' => $userEmail,
                'lastModified' => date('Y-m-d G:i:s')

            );
        } else {
            $changedPassword = password_hash($userPassword, PASSWORD_BCRYPT);
            $dataUser = array(
                'firstName' => $firstName,
                'userEmail' => $userEmail,
                'userPassword' => $changedPassword,
                'lastModified' => date('Y-m-d G:i:s')

            );
        }

        $this->db->where('userId=',$adminId);
        $this->db->update("im_users", $dataUser);
        $this->db->where('adminId=',$adminId);
        $dataRole = array(
            'adminType' => $role
        );
        $this->db->update('im_admintype', $dataRole);
    }
    public function arrayToObject($d){
        if(is_array($d)){
            return (object)array_map(__FUNCTION__,$d);
        }
        else{
            return $d;
        }
    }
}