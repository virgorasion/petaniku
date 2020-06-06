<?php

class Im_mutelist extends CI_Model{

    public $g_id; // g_id
    public $u_id;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model("Im_group_Model");
    }

    public function insert($u_id,$g_id)
    {

            if($this->ifExist($u_id,$g_id)){
                return;
            }
            $this->g_id=$g_id;
            $this->u_id=$u_id;
            $this->db->insert("im_mutelist",$this);
            $this->Im_group_Model->updateLastActiveDate($g_id,null);

    }


    public function delete($u_id,$g_id)
    {
        $this->db->where("g_id",$g_id);
        $this->db->where("u_id",$u_id);
        $this->db->delete("im_mutelist");
        $this->Im_group_Model->updateLastActiveDate($g_id,null);
    }


    public function getMuteList($u_id)
    {
        $this->db->select("g_id");
        $this->db->where("u_id",$u_id);
        $query = $this->db->get("im_mutelist");
        return $this->arrayToObject($query->result());
    }

    public function getTotalMuteListMember($u_id){
        $this->db->select("count(g_id) as total");
        $this->db->where("u_id",$u_id);
        $query = $this->db->get("im_mutelist");
        return (int)$query->row()->total;
    }

    public function ifExist($u_id,$g_id){
        $this->db->where('g_id', $g_id);
        $this->db->where('u_id', $u_id);

        $this->db->from('im_mutelist');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
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