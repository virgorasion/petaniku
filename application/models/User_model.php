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

	public function withdraw_balance($id,$amount)
	{
		return $this->db->update('users',['balance'=>0,'wd_balance'=>$amount],['id'=>$id]);
	}
	public function generatingDates($start_date, $end_date) {
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
		return $dates;
	}
	public function dashboard_summary()
	{
		$end_date = date('Y-m-d H:i:s');
		$start_date = date('Y-m-d H:i:s', strtotime('-7 days'));

		$pendingProduct = $this->db->query("SELECT id, title, created_at FROM products WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND status = 0 AND is_draft = 0 AND is_deleted = 0")->result_array();
		$payouts = $this->db->query("SELECT id, created_at FROM payouts WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND status = 0")->result_array();
		$transactions = $this->db->query("SELECT id, created_at FROM transactions WHERE created_at >= '$start_date' AND created_at <= '$end_date'")->result_array();
		$openShop = $this->db->query("SELECT id, created_at FROM users WHERE created_at >= '$start_date' AND created_at <= '$end_date' AND is_active_shop_request = 1")->result_array();
		
		$newDatas = [
			"pending_product" => [],
			"payouts" => [],
			"transactions" => [],
			"shops" => [],
		];
		
		// bind created_at from timestamp to date Y-m-d
		foreach ($pendingProduct as $product) {
			$product['created_at'] = explode(" ", $product['created_at'])[0];
			$newDatas['pending_product'][] = $product;
		}
		foreach ($payouts as $po) {
			$po['created_at'] = explode(" ", $po['created_at'])[0];
			$newDatas['payouts'][] = $po;
		}
		foreach ($transactions as $trx) {
			$trx['created_at'] = explode(" ", $trx['created_at'])[0];
			$newDatas['transactions'][] = $trx;
		}
		foreach ($openShop as $shop) {
			$shop['created_at'] = explode(" ", $shop['created_at'])[0];
			$newDatas['shops'][] = $shop;
		}

		$dates['pending_product'] = $this->generatingDates($start_date, $end_date);
		$dates['payouts'] = $this->generatingDates($start_date, $end_date);
		$dates['transactions'] = $this->generatingDates($start_date, $end_date);
		$dates['shops'] = $this->generatingDates($start_date, $end_date);

		// group data based on created_at (registered date)
		foreach ($newDatas['pending_product'] as $data) {
			if (!array_key_exists($data['created_at'], $dates)) {
				$dates['pending_product'][$data['created_at']] = [];
			}
			$dates['pending_product'][$data['created_at']][] = $data;
		}
		foreach ($newDatas['payouts'] as $data) {
			if (!array_key_exists($data['created_at'], $dates)) {
				$dates['payouts'][$data['created_at']] = [];
			}
			$dates['payouts'][$data['created_at']][] = $data;
		}
		foreach ($newDatas['transactions'] as $data) {
			if (!array_key_exists($data['created_at'], $dates)) {
				$dates['transactions'][$data['created_at']] = [];
			}
			$dates['transactions'][$data['created_at']][] = $data;
		}
		foreach ($newDatas['shops'] as $data) {
			if (!array_key_exists($data['created_at'], $dates)) {
				$dates['shops'][$data['created_at']] = [];
			}
			$dates['shops'][$data['created_at']][] = $data;
		}
		return $dates;
	}
}
