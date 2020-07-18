<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_controller extends Home_Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!auth_check()) {
			redirect(lang_base_url());
		}
		if (!is_sale_active()) {
			redirect(lang_base_url());
		}
		$this->order_per_page = 15;
		$this->earnings_per_page = 15;
		$this->user_id = user()->id;
	}

	/**
	 * Orders
	 */
	public function orders()
	{
		$data = $this->build_orders_data();

		/*
		$data['title'] = trans("orders");
		$data['description'] = trans("orders") . " - " . $this->app_name;
		$data['keywords'] = trans("orders") . "," . $this->app_name;
		*/
		$data["active_tab"] = "active_orders";
		

		/*
		$pagination = $this->paginate(lang_base_url() . 'orders', $this->order_model->get_orders_count($this->user_id), $this->order_per_page);
		$data['orders'] = $this->order_model->get_paginated_orders($this->user_id, $pagination['per_page'], $pagination['offset']);
		*/
		
		$this->load->view('partials/_header', $data);
		$this->load->view('order/orders', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Completed Orders
	 */
	public function completed_orders()
	{
		$data = $this->build_orders_data();

		/*
		$data['title'] = trans("orders");
		$data['description'] = trans("orders") . " - " . $this->app_name;
		$data['keywords'] = trans("orders") . "," . $this->app_name;
		*/
		$data["active_tab"] = "completed_orders";

		/*
		$pagination = $this->paginate(lang_base_url() . 'orders', $this->order_model->get_completed_orders_count($this->user_id), $this->order_per_page);
		$data['orders'] = $this->order_model->get_paginated_completed_orders($this->user_id, $pagination['per_page'], $pagination['offset']);
		*/

		$this->load->view('partials/_header', $data);
		$this->load->view('order/orders', $data);
		$this->load->view('partials/_footer');
	}

	protected function build_orders_data()
	{
		$data["form_action"] = lang_base_url() . 'orders';

		$data['title'] = trans("orders");
		$data['description'] = trans("orders") . " - " . $this->app_name;
		$data['keywords'] = trans("orders") . "," . $this->app_name;

		$per_page = $this->input->get('show') ?: $this->order_per_page;

		$pagination = $this->paginate(
			lang_base_url() . 'orders',
			$this->order_model->get_orders_count($this->user_id),
			$per_page
		);
		$data['orders'] = $this->order_model->get_paginated_orders(
			$this->user_id,
			$pagination['per_page'],
			$pagination['offset']
		);

		$completed_pagination = $this->paginate(
			lang_base_url() . 'orders',
			$this->order_model->get_completed_orders_count($this->user_id),
			$per_page
		);
		$data['completed_orders'] = $this->order_model->get_paginated_completed_orders(
			$this->user_id,
			$completed_pagination['per_page'],
			$completed_pagination['offset']
		);

		return $data;
	}

	/**
	 * Order
	 */
	public function order($order_number)
	{
		$data['title'] = trans("orders");
		$data['description'] = trans("orders") . " - " . $this->app_name;
		$data['keywords'] = trans("orders") . "," . $this->app_name;
		$data["active_tab"] = "";

		$data["order"] = $this->order_model->get_order_by_order_number($order_number);
		if (empty($data["order"])) {
			redirect(lang_base_url());
		}
		if ($data["order"]->buyer_id != $this->user_id) {
			redirect(lang_base_url());
		}
		$data["order_products"] = $this->order_model->get_order_products($data["order"]->id);
		$data["order_shipping"] = $this->order_model->get_order_shipping($data["order"]->id);
		// $data["order_variation"] = $this->order_model->get_product_variation($data['order_products'][0]->id);
		
		$data["last_bank_transfer"] = $this->order_admin_model->get_bank_transfer_by_order_number($data["order"]->order_number);

		if (isset($_GET['is_ajax']) && $_GET['is_ajax'] === 'yes') {
			$result = [
				'status' => 'success',
				'html' => $this->load->view('order/order_detail_ajax', $data, true),
			];

			echo json_encode($result);
			exit;
		}

		$this->load->view('partials/_header', $data);
		$this->load->view('order/order', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Bank Transfer Payment Report Post
	 */
	public function bank_transfer_payment_report_post()
	{
		$this->order_model->add_bank_transfer_payment_report();
		redirect($this->agent->referrer());
	}

	// Shipping note
	public function shipping_report_post()
	{
		if ($this->input->post("shipping_note") != NULL || $this->input->post("file") != NULL) {
			$this->order_model->add_shipping_note();
		}
		$this->update_order_product_status_post();
		redirect($this->agent->referrer());
	}

	/**
	 * Sales
	 */
	public function sales()
	{
		if (!is_user_vendor()) {
			redirect(lang_base_url());
		}

		$data = $this->get_sales_data();

		/*
		$data['title'] = trans("sales");
		$data['description'] = trans("sales") . " - " . $this->app_name;
		$data['keywords'] = trans("sales") . "," . $this->app_name;
		*/
		$data["active_tab"] = "active_sales";
		
		$this->load->view('partials/_header', $data);
		$this->load->view('sale/sales', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Completed Sales
	 */
	public function completed_sales()
	{
		if (!is_user_vendor()) {
			redirect(lang_base_url());
		}

		$data = $this->get_sales_data();

		/*
		$data['title'] = trans("sales");
		$data['description'] = trans("sales") . " - " . $this->app_name;
		$data['keywords'] = trans("sales") . "," . $this->app_name;
		*/
		$data["active_tab"] = "completed_sales";
		
		$this->load->view('partials/_header', $data);
		$this->load->view('sale/sales', $data);
		$this->load->view('partials/_footer');
	}

	protected function get_sales_data()
	{
		$data["form_action"] = lang_base_url() . 'orders';

		$data['title'] = trans("sales");
		$data['description'] = trans("sales") . " - " . $this->app_name;
		$data['keywords'] = trans("sales") . "," . $this->app_name;

		$per_page = $this->input->get('show') ?: $this->order_per_page;
		
		$pagination = $this->paginate(lang_base_url() . 'sales', $this->order_model->get_sales_count($this->user_id), $per_page);
		$data['orders'] = $this->order_model->get_paginated_sales($this->user_id, $pagination['per_page'], $pagination['offset']);

		$completed_pagination = $this->paginate(lang_base_url() . 'sales', $this->order_model->get_completed_sales_count($this->user_id), $per_page);
		$data['completed_orders'] = $this->order_model->get_paginated_completed_sales($this->user_id, $completed_pagination['per_page'], $completed_pagination['offset']);

		return $data;
	}

	/**
	 * Sale
	 */
	public function sale($order_number)
	{
		if (!is_user_vendor()) {
			redirect(lang_base_url());
		}

		$data['title'] = trans("sales");
		$data['description'] = trans("sales") . " - " . $this->app_name;
		$data['keywords'] = trans("sales") . "," . $this->app_name;
		$data["active_tab"] = "";
		
		$data["order"] = $this->order_model->get_order_by_order_number($order_number);
		if (empty($data["order"])) {
			redirect(lang_base_url());
		}
		if (!$this->order_model->check_order_seller($data["order"]->id)) {
			redirect(lang_base_url());
		}
		$data["order_products"] = $this->order_model->get_order_products($data["order"]->id);

		$this->load->view('partials/_header', $data);
		$this->load->view('sale/sale', $data);
		$this->load->view('partials/_footer');
	}


	/**
	 * Update Order Product Status Post
	 */
	public function update_order_product_status_post()
	{
		$id = $this->input->post('order_id', true);
		$order_product = $this->order_model->get_order_product($id);
		if (!empty($order_product)) {
			if ($this->order_model->update_order_product_status($id)) {

				//add digital sale if payment received
				$order_status = $this->input->post('order_status', true);
				if ($order_status == 'completed' || $order_status == 'payment_received') {
					$this->order_model->add_digital_sale($order_product->product_id, $order_product->order_id);
				}
				$this->order_admin_model->update_payment_status_if_all_received($order_product->order_id);
				$this->order_admin_model->update_order_status_if_completed($order_product->order_id);

			}
		}
		redirect($this->agent->referrer());
	}

	/**
	 * Add Shipping Tracking Number Post
	 */
	public function add_shipping_tracking_number_post()
	{
		$id = $this->input->post('id', true);
		$order_product = $this->order_model->get_order_product($id);
		if (!empty($order_product)) {
			$this->order_model->add_shipping_tracking_number($id);
		}
		redirect($this->agent->referrer());
	}

	/**
	 * Approve Order Product
	 */
	public function approve_order_product_post()
	{
		$order_id = $this->input->post('order_product_id', true);
		$order_product_id = $this->input->post('order_product_id', true);
		if ($this->order_model->approve_order_product($order_product_id)) {
			//order product
			$order_product = $this->order_model->get_order_product($order_product_id);
			//add seller earnings
			$this->earnings_model->add_seller_earnings($order_product);
			//update order status
			$this->order_admin_model->update_order_status_if_completed($order_product->order_id);
		}
	}
	
	/**
	 * Cancel Order
	 */
	public function report_cancel_order()
	{
		$order_number = $this->input->post('order_number', true);
		$note_cancel = $this->input->post('note_cancel', true);
		$query = $this->order_model->request_cancel_order($order_number,$note_cancel);
		redirect($this->agent->referrer());
	}

	public function cancel_order()
	{
		$this->order_model->cancel_order($this->input->post("order_id"));
		redirect($this->agent->referrer());
	}

}
