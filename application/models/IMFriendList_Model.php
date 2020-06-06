<?php

class IMFriendList_Model extends CI_Model{
    public $userId;
    public $friendId;

    public function __construct()
    {
        parent::__construct();
    }
    public function insert($userid,$friendId){
        $this->userId=$userid;
        $this->friendId=$friendId;
        $this->db->insert("im_friend_list",$this);
    }
    public function delete($userId,$friendId){
        $this->db->where("userId",$userId);
        $this->db->where("friendId",$friendId);
        $this->db->delete("im_friend_list");
    }

    public function getList($userId,$limit,$start){
        $this->db->select("friendId");
        $this->db->where("userId",$userId);
        if($start!=null && $limit!=null){
            $query=$this->db->get("im_friend_list",$limit,$start);
        }else{
            $query=$this->db->get("im_friend_list");
        }

        return $query->result();
    }

    public function getFriendsIdAsArray($userId){
        $this->db->select("friendId");
        $this->db->where("userId",$userId);
        $query=$this->db->get("im_friend_list");
        $array=array();
        foreach ($query->result() as $id){
            array_push($array,$id->friendId);
        }
        return $array;
    }
    function friendExist($userId,$friendId)
    {
        $this->db->where("userId",$userId);
        $this->db->where("friendId",$friendId);
        $this->db->from('im_friend_list');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function getTotalFriend($userId){
        $this->db->select("count(friendId) as total");
        $query=$this->db->get("im_friend_list");
        return $query->row()->total;
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