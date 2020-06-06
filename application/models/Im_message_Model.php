<?php

class Im_message_Model extends CI_Model{

    public $sender;
    public $receiver;
    public $message;
    public $type;
    public $fileName;
    public $receiver_type;
    public $date;
    public $time;
    public $date_time;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insert($u_id,$g_id,$message,$type,$fileName,$receiver_type,$date,$time,$date_time)
    {
        $this->sender=$u_id;
        $this->receiver=$g_id;
        $this->message=$message;
        $this->type=$type;
        $this->fileName=$fileName;
        $this->receiver_type=$receiver_type;
        $this->date=$date;
        $this->time=$time;
        $this->date_time=$date_time;
        $this->db->insert("im_message",$this);
        return $this->db->insert_id();
    }

    public function getMessage($g_id, $start, $limit)
    {
        $this->db->where("receiver",$g_id);
        $this->db->order_by("date_time DESC,m_id DESC");
        $query = $this->db->get("im_message",$limit,$start);
        $prepareData=array();
        foreach ($query->result() as $result){
            $result->poster="";
            if($result->type!="text" && $result->type!="document" && $result->type!="update"){
                $result->message=base_url() . "assets/im/im/group_".$g_id."/".$result->message;
            }
            if($result->type=="document"){
                $fileUrl=urlencode("assets/im/im/group_".$g_id."/".$result->message)."&fn=".urlencode($result->fileName);
                $result->message=base_url()."download?f=".$fileUrl;
            }
            if($result->type=="video"){
                $result->poster=base_url("assets/im/img/poster.jpg");
            }
            $prepareData[]=$result;
        }
        return $prepareData;
    }
    public function getGroupFiles($g_id){
        $type=array("document","video","audio");
        $this->db->select("m_id,message,fileName,type");
        $this->db->where("receiver",$g_id)
            ->where_in("type",$type);
        $this->db->order_by("date_time DESC");
        $query = $this->db->get("im_message");
        $prepareData=array();
        foreach ($query->result() as $result){
            $fileUrl=urlencode( "assets/im/im/group_".$g_id."/".$result->message)."&fn=".urlencode($result->fileName);
            $result->message=base_url()."download?f=".$fileUrl;
            if($result->type=="document"){
                $result->type=pathinfo("/assets/im/im/group_".$g_id."/".$result->message,PATHINFO_EXTENSION);
            }
            $prepareData[]=$result;
        }
        return $prepareData;
    }
    public function getGroupImages($g_id){
        $this->db->select("m_id,message,fileName,type");
        $this->db->where("receiver",$g_id)
            ->where("type","image");
        $this->db->order_by("date_time DESC");
        $query = $this->db->get("im_message");
        $prepareData=array();
        foreach ($query->result() as $result){
            $result->message=base_url("image?u=").urlencode(base_url() . "assets/im/im/group_".$g_id."/".$result->message);
            $prepareData[]=$result;
        }
        return $prepareData;
    }
    public function getRecentMessage($g_id)
    {
        $this->db->where("receiver",$g_id);
        $this->db->where("type <>","update");
        $this->db->order_by("m_id DESC");

        $query = $this->db->get("im_message",1);
        $prepareData=$this->arrayToObject($query->row());
        if($prepareData!=null){
            $prepareData->poster="";
            if( $prepareData->type!="text" && $prepareData->type!="update" && $prepareData->type!="document"){
                $prepareData->message=base_url() . "assets/im/im/group_" .$g_id."/". $prepareData->message;
            }
            if($prepareData->type=="document"){
                $fileUrl=urlencode( "assets/im/im/group_".$g_id."/".$prepareData->message)."&fn=".urlencode($prepareData->fileName);
                $prepareData->message=base_url()."download?f=".$fileUrl;
            }
            if($prepareData->type=="video"){
                $prepareData->poster=base_url("assets/im/img/poster.jpg");
            }
        }

         return $prepareData;
    }
    public function getRecentMessageWithUpdate($g_id)
    {
        $this->db->where("receiver",$g_id);
       // $this->db->where("type <>","update");
        $this->db->order_by("m_id DESC");

        $query = $this->db->get("im_message",1);
        $prepareData=$query->row();
        if($prepareData!=null){
            $prepareData->poster="";
            if( $prepareData->type!="text" && $prepareData->type!="document" && $prepareData->type!="update"){
                $prepareData->message=base_url() . "assets/im/im/group_" .$g_id."/". $prepareData->message;
            }
            if($prepareData->type=="document"){
                $fileUrl=urlencode( "assets/im/im/group_".$g_id."/".$prepareData->message)."&fn=".urlencode($prepareData->fileName);
                $prepareData->message=base_url()."download?f=".$fileUrl;
            }
            if($prepareData->type=="video"){
                $prepareData->poster=base_url("assets/im/img/poster.jpg");
            }
        }

        return $this->arrayToObject($prepareData);
    }
    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    public function getTotalMessage($g_id){
        $this->db->select("count(m_id) as total");
        $this->db->where("receiver",$g_id);
        $query = $this->db->get("im_message");
        return $query->row()->total;
    }
    public function DeleteAll($g_id){
        $dirPath="assets/im/im/group_".$g_id;
        if(is_dir($dirPath)){
            self::deleteDir($dirPath);
        }
        $this->db->where("receiver",$g_id);
        return $this->db->delete("im_message");
    }

    public function searchMessageLike($g_id,$searchText){
        $data=$this->db->where("receiver",$g_id)
            ->where("type","text")
            ->where("onlyemoji",0)
            ->like("message",$searchText,'both',true)
            ->get("im_message");

        return [
            'messages'=>$data->result_object(),
            'numberOfRow'=>$data->num_rows()
            ];
    }


    public function searchMessages($g_id,$m_id){

        $data=$this->db->where('m_id>=',$m_id)
            ->where('receiver',$g_id)
            ->where("type","text")
            ->where("onlyemoji",0)
            ->get('im_message',15);

        $prepareData=array();
        foreach ($data->result_object() as $result){
            $result->poster="";
            if($result->type!="text" && $result->type!="document" && $result->type!="update"){
                $result->message=base_url() . "assets/im/im/group_".$g_id."/".$result->message;
            }
            if($result->type=="document"){
                $fileUrl=urlencode("assets/im/im/group_".$g_id."/".$result->message)."&fn=".urlencode($result->fileName);
                $result->message=base_url()."download?f=".$fileUrl;
            }
            if($result->type=="video"){
                $result->poster=base_url("assets/im/img/poster.jpg");
            }
            $prepareData[]=$result;
        }
        return $prepareData;
    }

    public function getSearchMessageUpper($g_id,$m_id){
        $data=$this->db->where('m_id<',$m_id)
            ->where('receiver',$g_id)
            ->where("type!=","update")
            ->where("onlyemoji",0)
            ->order_by('m_id','DESC')
            ->get('im_message',15);

        $prepareData=array();
        foreach ($data->result_object() as $result){
            $result->poster="";
            if($result->type!="text" && $result->type!="document" && $result->type!="update"){
                $result->message=base_url() . "assets/im/im/group_".$g_id."/".$result->message;
            }
            if($result->type=="document"){
                $fileUrl=urlencode("assets/im/im/group_".$g_id."/".$result->message)."&fn=".urlencode($result->fileName);
                $result->message=base_url()."download?f=".$fileUrl;
            }
            if($result->type=="video"){
                $result->poster=base_url("assets/im/img/poster.jpg");
            }
            $prepareData[]=$result;
        }
        return $prepareData;
    }

    public function getSearchMessageLower($g_id,$m_id){
        $data=$this->db->where('m_id>',$m_id)
            ->where('receiver',$g_id)
            ->where("onlyemoji",0)
            ->where("type!=","update")
            ->get('im_message',15);

        $prepareData=array();
        foreach ($data->result_object() as $result){
            $result->poster="";
            if($result->type!="text" && $result->type!="document" && $result->type!="update"){
                $result->message=base_url() . "assets/im/im/group_".$g_id."/".$result->message;
            }
            if($result->type=="document"){
                $fileUrl=urlencode("assets/im/im/group_".$g_id."/".$result->message)."&fn=".urlencode($result->fileName);
                $result->message=base_url()."download?f=".$fileUrl;
            }
            if($result->type=="video"){
                $result->poster=base_url("assets/im/img/poster.jpg");
            }
            $prepareData[]=$result;
        }
        return $prepareData;
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