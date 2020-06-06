<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function get_users()
	{
		$query = $this->db->get('users');
		return $query->result();
	}

	public function get_user($id)
	{
		$id = clean_number($id);
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->result();
	}

	public function get_last_users()
	{
		$this->db->limit(5);
		$query = $this->db->get('users');
		return $query->result();
	}

	public function delete_user($id)
	{
		$id = clean_number($id);
		$user = $this->get_user($id);

		if (!empty($user)) {
			$this->db->where('id', $id);
			return $this->db->delete('users');
		}
		return false;
	}
}
