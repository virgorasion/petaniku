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

		$pendingProduct = $this->db->query("SELECT id, created_at FROM products WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND status = 0 AND is_draft = 0 AND is_deleted = 0")->result_array();
		$payouts = $this->db->query("SELECT id, created_at FROM payouts WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND status = 0")->result_array();
		$transactions = $this->db->query("SELECT id, created_at FROM transactions WHERE created_at >= '$start_date' AND created_at <= '$end_date'")->result_array();
		$openShop = $this->db->query("SELECT id, created_at FROM users WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND is_active_shop_request = 1")->result_array();

		$newDatas = [];
		foreach ($pendingProduct as $product) {
			// bind created_at from timestamp to date Y-m-d
			$product['created_at'] = explode(" ", $product['created_at'])[0];
			$newDatas['pendingProduct'][] = $product;
		}
		// foreach ($payouts as $pay) {
		// 	// bind created_at from timestamp to date Y-m-d
		// 	$pay['created_at'] = explode(" ", $pay['created_at'])[0];
		// 	$newDatas['payouts'][] = $pay;
		// }
		// foreach ($transactions as $trx) {
		// 	// bind created_at from timestamp to date Y-m-d
		// 	$trx['created_at'] = explode(" ", $trx['created_at'])[0];
		// 	$newDatas['trx'][] = $trx;
		// }
		// foreach ($openShop as $shop) {
		// 	// bind created_at from timestamp to date Y-m-d
		// 	$shop['created_at'] = explode(" ", $shop['created_at'])[0];
		// 	$newDatas['openShop'][] = $shop;
		// }
		
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

		foreach ($newDatas as $data) {
			// var_dump($data[0]['id']);
			// group data based on created_at (registered date)
			if (!array_key_exists($data[0]['created_at'], $dates)) {
				$dates[$data[0]['created_at']] = [];
			}	
			$dates[$data[0]['created_at']][] = $data;
		}
		dd($dates);
		return $dates;
	}
}
