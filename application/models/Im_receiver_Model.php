<?php
class Im_receiver_Model extends CI_Model{


    public function update($r_id,$g_id,$m_id,$time){
        $update=array(
            "received"=>1,
            "time"=>$time
        );
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->update("im_receiver",$update);

    }
    public function updateAnnounced($r_id,$g_id,$m_id){
        $update=array(
            "announced"=>1,

        );
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->update("im_receiver",$update);

    }
    public function addPendingForNewMember($r_id,$g_id,$m_id){

        $this->g_id=$g_id;
        $this->r_id=$r_id;
        $this->m_id=$m_id;
        $this->received=0;

        $this->db->insert("im_receiver",$this);

    }
    public function getTotalReceiver($m_id){
        $query=$this->db->select("count(m_id) as total")
            ->where("m_id",$m_id)
            ->where("received",1)
            ->get("im_receiver");
        
        return $query->row()->total;
        
    }
    public function isExsist($m_id,$r_id,$g_id){
        $this->db->where("m_id",$m_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("g_id",$g_id);
        $this->db->from('im_receiver');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function isNotReceived($r_id,$g_id,$m_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->where("received",0);
        $this->db->from('im_receiver');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function isReceived($r_id,$g_id,$m_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->where("received",1);
        $this->db->from('im_receiver');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function isAnnounced($r_id,$g_id,$m_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->where("announced",1);
        $this->db->from('im_receiver');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function getReceivedMessageTime($r_id,$g_id,$m_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        $this->db->where("received",1);
        return  $this->arrayToObject($this->db->get('im_receiver')->row("time"));
    }
    public function DeleteAll($g_id,$r_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        return $this->db->delete("im_receiver");
    }


    public function DeletePendingMessage($g_id,$r_id,$m_id){
        $this->db->where("g_id",$g_id);
        $this->db->where("r_id",$r_id);
        $this->db->where("m_id",$m_id);
        return $this->db->delete("im_receiver");
    }

    public function deleteByMessageId($m_id){

        $this->db->where("m_id",$m_id);
        return $this->db->delete("im_receiver");
    }
    public function deleteByGroupId($g_id){

        $this->db->where("g_id",$g_id);
        return $this->db->delete("im_receiver");
    }

    public function getGroupPendingMessage($g_id,$u_id){
        $this->db->select("(CASE WHEN COUNT(m_id) >= 100 THEN 99 ELSE COUNT(m_id) END) as pending, g_id as groupId")
            ->where("r_id",$u_id)
            ->where("g_id",$g_id)
            ->where("received",0)
            ->group_by("g_id");
        return (int)$this->db->get("im_receiver")->row("pending");
    }

    public function getTotalPendingMessage($u_id){
        $this->db->select("(CASE WHEN COUNT(m_id) >= 100 THEN 99 ELSE COUNT(m_id) END) as pending")
            ->where("r_id",$u_id)
            ->where("received",0)
            ->group_by("g_id");
        return (int)$this->db->get("im_receiver")->result();
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