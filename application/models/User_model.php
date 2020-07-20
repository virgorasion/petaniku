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

	public function empty_balance($id)
	{
		return $this->db->where('id', $id)->set('balance', 0)->update('users');
	}
	public function registered_in_week()
	{
		$end_date = date('Y-m-d H:i:s');
		$start_date = date('Y-m-d H:i:s', strtotime('-6 days'));

		$users = $this->db->query("SELECT id, created_at FROM users WHERE created_at >= '$start_date' AND created_at <= '$end_date'")->result_array();

		$newDatas = [];
		foreach ($users as $user) {
			// bind created_at from timestamp to date Y-m-d
			$user['created_at'] = explode(" ", $user['created_at'])[0];
			$newDatas[] = $user;
		}

		// generating dates in a week
		$dates = [];
		$period = new DatePeriod(
			new DateTime($start_date),
			new DateInterval('P1D'),
			new DateTime($end_date)
		);
		foreach ($period as $val) {
			$dates[$val->format('Y-m-d')] = [];
		}

		foreach ($newDatas as $user) {
			// group data based on created_at (registered date)
			if (!array_key_exists($user['created_at'], $dates)) {
				$dates[$user['created_at']] = [];
			}	
			$dates[$user['created_at']][] = $user;
		}

		return $dates;
	}
}
