<?php

class Im_blocklist extends CI_Model{

    public $g_id;
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
            $this->db->insert("im_blocklist",$this);
            $this->Im_group_Model->updateLastActiveDate($g_id,null);
    }


    public function delete($u_id,$g_id)
    {
        $this->db->where("g_id",$g_id);
        $this->db->where("u_id",$u_id);
        $this->db->delete("im_blocklist");
        $this->Im_group_Model->updateLastActiveDate($g_id,null);

    }


    public function getBlockList($u_id)
    {
        $this->db->select("g_id");
        $this->db->where("u_id",$u_id);
        $query = $this->db->get("im_blocklist");
        return $this->arrayToObject($query->result());
    }
    public function getBlockListUserIds($u_id)
    {
        $this->db->distinct();
        $this->db->select("igm.u_id, ibl.g_id");
        $this->db->from("im_group_members igm");
        $this->db->join("im_blocklist ibl","ibl.g_id=igm.g_id","INNER");
        $this->db->where("ibl.u_id=",$u_id)->where("igm.u_id<>",$u_id);
        $query = $this->db->get("im_group_members");
        return $query->result();
       // return $this->db->last_query();
    }

    public function ifExistInList($u_id,$memberIds){

            $this->db->distinct();
            $this->db->select("igm.u_id");
            $this->db->from("im_group_members igm");
            $this->db->join("im_blocklist ibl","ibl.g_id=igm.g_id","INNER");
            $this->db->where("ibl.u_id",$u_id)->where("igm.u_id<>",$u_id)->where_in("igm.u_id",$memberIds);
            if ($this->db->count_all_results() == 0) {
                return false;
            } else {
                return true;
            }


    }

    public function getTotalBlockListMember($u_id){
        $this->db->select("count(g_id) as total");
        $this->db->where("u_id",$u_id);
        $query = $this->db->get("im_blocklist");
        return (int)$query->row()->total;
    }

    public function ifExist($u_id,$g_id){
        $this->db->where('g_id', $g_id);
        $this->db->where('u_id', $u_id);

        $this->db->from('im_blocklist');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }
   public function ifGroupInList($g_id){
       $this->db->where('g_id', $g_id);

       $this->db->from('im_blocklist');
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