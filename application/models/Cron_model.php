<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{
    public function get_transactions(){
        $this->db->where("payment_status","awaiting_payment");
        return $this->db->get("transactions")->result();
    }
}