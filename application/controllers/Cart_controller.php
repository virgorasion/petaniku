<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends Home_Core_Controller
{
	/*
	 * Payment Types
	 *
	 * 1. sale: Product purchases
	 * 2. promote: Promote purchases
	 *
	 */

	public function __construct()
	{
		parent::__construct();

		if (!is_sale_active()) {
			redirect(lang_base_url());
		}

		$this->cart_model->calculate_cart_total();
	}

	/**
	 * Cart
	 */
	public function cart()
	{
		$data['title'] = trans("shopping_cart");
		$data['description'] = trans("shopping_cart") . " - " . $this->app_name;
		$data['keywords'] = trans("shopping_cart") . "," . $this->app_name;

		$data['cart_items'] = $this->cart_model->get_sess_cart_items();
		$data['cart_total'] = $this->cart_model->get_sess_cart_total();
		$data['cart_has_physical_product'] = $this->cart_model->check_cart_has_physical_product();
		

		if(count($data['cart_items']) > 0) {
			header('Location: cart/shipping');
		} else {
			header('Location: /');			
		}

		$this->load->view('partials/_header', $data);
		$this->load->view('cart/cart', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Add to Cart
	 */
	public function add_to_cart()
	{
		$product_id = $this->input->post('product_id', true);
		$product = $this->product_model->get_product_by_id($product_id);
		$user = get_logged_user();

		if($user->email == null) {
			$this->session->set_flashdata('product_details_error', "Silahkan daftar / masuk terlebih dahulu");						
		}
		
		if($user->shipping_state == null) {
			// $this->session->set_flashdata('product_details_error', "Silahkan update profil alamat pengiriman terlebih dahulu di " . base_url('settings/shipping-address'));			
		} else {
			// replaced by if (true) {}
		}

		if (true) {
			// $ongkir = $this->product_model->get_list_ongkir_by_user($product_id, $user);
			// if (empty($ongkir)) {
			// 	$this->session->set_flashdata('product_details_error', "Alamat Anda sepertinya diluar area pengiriman penjual. Hubungi penjual utk info lebih lanjut");
			// 	redirect($this->agent->referrer());
			// }

			if (!empty($product)) {
				if ($product->status != 1) {
					$this->session->set_flashdata('product_details_error', trans("msg_error_cart_unapproved_products"));
				} else {
					$this->cart_model->clear_cart();
					$this->cart_model->add_to_cart($product, $ongkir->ongkir);
					// redirect(lang_base_url() . 'cart');
					redirect(lang_base_url() . 'cart/shipping');
				}
			}
		}

		redirect($this->agent->referrer());
	}

	/**
	 * Add to Cart qQuote
	 */
	public function add_to_cart_quote()
	{
		$quote_request_id = $this->input->post('id', true);
		if (!empty($this->cart_model->add_to_cart_quote($quote_request_id))) {
			redirect(lang_base_url() . 'cart');
		}
		redirect($this->agent->referrer());
	}

	/**
	 * Remove from Cart
	 */
	public function remove_from_cart()
	{
		$cart_item_id = $this->input->post('cart_item_id', true);
		$this->cart_model->remove_from_cart($cart_item_id);
	}

	/**
	 * Update Cart Product Quantity
	 */
	public function update_cart_product_quantity()
	{
		$product_id = $this->input->post('product_id', true);
		$cart_item_id = $this->input->post('cart_item_id', true);
		$quantity = $this->input->post('quantity', true);
		$this->cart_model->update_cart_product_quantity($product_id, $cart_item_id, $quantity);
	}

	/**
	 * Shipping
	 */
	public function shipping()
	{
		$data['title'] = trans("shopping_cart");
		$data['description'] = trans("shopping_cart") . " - " . $this->app_name;
		$data['keywords'] = trans("shopping_cart") . "," . $this->app_name;
		
		$data['cart_items'] = $this->cart_model->get_sess_cart_items();
		$data['mds_payment_type'] = 'sale';

		if ($data['cart_items'] == null) {
			redirect(lang_base_url() . "cart");
		}
		//check shipping status
		if ($this->form_settings->shipping != 1) {
			redirect(lang_base_url() . "cart");
			exit();
		}
		//check guest checkout
		if (empty($this->auth_check) && $this->general_settings->guest_checkout != 1) {
			die('Please login first');						
			redirect(lang_base_url() . "cart");
			exit();
		}
		//check physical products
		if ($this->cart_model->check_cart_has_physical_product() == false) {
			redirect(lang_base_url() . "cart");
			exit();
		}

		//update 1 checkout, 1 barang
		$produk = $this->product_model->get_product_by_id($data['cart_items'][0]->product_id);
		$data['product'] = $produk;
		$data["states"] = $this->locationid_model->get_states_by_country($produk->country_id);
		$listongkir = $this->product_model->get_product_ongkirs($produk->id);
		$provinsi_pengiriman = [];
		$kota_pengiriman = [];
		foreach((array) $listongkir as $r){
			$provinsi_pengiriman[$r->state_id] = "";
		}
		foreach((array) $listongkir as $r){
			$kota_pengiriman[$r->city_id] = "";
		}
		$data['kirim_ke_provinsi']  = array_keys($provinsi_pengiriman);
		$data['kirim_ke_kota'] = array_keys($kota_pengiriman);

		$data["shipping_address"] = $this->cart_model->get_sess_cart_shipping_address();
		$data["countries"] = $this->locationid_model->get_countries();
		// $data["states"] = $this->location_model->get_states_by_country($this->auth_user->country_id);

		if($this->session->flashdata('product_details_error')) {
			$data["cities"] = $this->locationid_model->get_cities_by_state($data["shipping_address"]->shipping_state);
			$data["kecamatan"] = $this->locationid_model->get_kecamatan_by_city($data["shipping_address"]->shipping_city);
		} else {
			if(!empty($data["shipping_address"])) {
				$data["cities"] = $this->locationid_model->get_cities_by_state($data['shipping_address']->shipping_state);							
				$data["kecamatan"] = $this->locationid_model->get_kecamatan_by_city($data["shipping_address"]->shipping_city);				
			} else {
				$data["cities"] = $this->locationid_model->get_cities_by_state($this->auth_user->shipping_state);
				$data["kecamatan"] = $this->locationid_model->get_kecamatan_by_city($this->auth_user->shipping_city);				
			}
		}

		$data['cart_total'] = $this->cart_model->get_sess_cart_total();
		// dd($data['cart_total']);
		$this->session->unset_userdata("check_cart_order");
		$this->session->unset_userdata("order_id");


		$this->load->view('partials/_header', $data);
		$this->load->view('cart/shipping', $data);
		$this->load->view('partials/_footer');
	}

	public function cek_ongkir($product_id=null)
	{
		$user = get_logged_user();	

		if(is_null($product_id)) {
			$carts = $this->cart_model->get_sess_cart_items();	
			$cart = $carts[0];
			$product_id = $cart->product_id;
		}
		
		$post = $_POST;
		$ongkir = $this->product_model->get_list_ongkir_by_select($product_id, $post['provinsi'], $post['kota'], $post['kecamatan']);	
		if(!is_null($ongkir)) {
			$ongkir = $ongkir->ongkir;
		}
		echo (int) $ongkir;	
	}

	/**
	 * Shipping Post
	 */
	public function shipping_post()
	{
		$this->profile_model->update_shipping_address();
		$this->cart_model->set_sess_cart_shipping_address();
		$user = get_logged_user();		
		$carts = $this->cart_model->get_sess_cart_items();	
		
		$sc_msg = "";

		foreach($carts as $cart) {
			$product_id = $cart->product_id;
			$product = $this->product_model->get_product_by_id($product_id);
			
			// $ongkir = $this->product_model->get_list_ongkir_by_user($product_id, $user);
			$ongkir = $_POST['ongkir'];
			if (empty($ongkir)) {
				$sc_msg .= "Produk <b>".$product->title."</b> tidak tersedia di wilayah Anda untuk area pengiriman penjual. Silahkan hubungi penjual atau hapus produk dari keranjang.<br>";
			} else {
				if (!empty($product)) {
					if ($product->status != 1) {
						$this->session->set_flashdata('product_details_error', trans("msg_error_cart_unapproved_products"));
					} else {
						$this->session->set_userdata('mds_shopping_cart_kodeunik', $cart->kode_unik);
						
						$this->cart_model->remove_from_cart($cart->cart_item_id);
						$this->cart_model->add_to_cart($product, $ongkir, $cart->quantity);
					}
				}
			}
		}

		if ($sc_msg != ""){
			$this->session->set_flashdata('product_details_error', $sc_msg);			
			redirect($this->agent->referrer());
		}

		redirect(lang_base_url() . "cart/payment-method?payment_type=sale");
	}

	/**
	 * Payment Method
	 */
	public function payment_method()
	{
		$data['title'] = trans("shopping_cart");
		$data['description'] = trans("shopping_cart") . " - " . $this->app_name;
		$data['keywords'] = trans("shopping_cart") . "," . $this->app_name;
		
		$data['mds_payment_type'] = 'sale';

		$payment_type = $this->input->get('payment_type', true);

		if (!empty($payment_type) && $payment_type == 'promote') {
			if ($this->promoted_products_enabled != 1) {
				redirect(lang_base_url());
			}
			$data['mds_payment_type'] = 'promote';
			$data['promoted_plan'] = $this->session->userdata('modesy_selected_promoted_plan');
			if (empty($data['promoted_plan'])) {
				redirect(lang_base_url());
			}
		} else {
			$data['cart_items'] = $this->cart_model->get_sess_cart_items();
			if ($data['cart_items'] == null) {
				redirect(lang_base_url() . "cart");
			}

			//check auth for digital products
			if (!auth_check() && $this->cart_model->check_cart_has_digital_product() == true) {
				$this->session->set_flashdata('error', trans("msg_digital_product_register_error"));
				redirect(lang_base_url() . 'register');
				exit();
			}

			$data['cart_total'] = $this->cart_model->get_sess_cart_total();
			$user_id = null;
			if (auth_check()) {
				$user_id = user()->id;
			}

			$data['cart_has_physical_product'] = $this->cart_model->check_cart_has_physical_product();
			$data['cart_has_digital_product'] = $this->cart_model->check_cart_has_digital_product();
			$this->cart_model->unset_sess_cart_payment_method();
		}

		$this->load->view('partials/_header', $data);
		$this->load->view('cart/payment_method', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Payment Method Post
	 */
	public function payment_method_post()
	{
		$this->cart_model->set_sess_cart_payment_method();
		$mds_payment_type = $this->input->post('mds_payment_type', true);
		if($_POST['payment_option'] == 'saldo') {
			$cart = $this->cart_model->get_sess_cart_total();
			$total = $cart->total;
			$balance = $this->auth_user->balance;
			
			if ($balance < $total) {
				$this->session->set_flashdata('error', "Maaf, saldo Anda tidak mencukupi untuk membayar belanjaan");		
				redirect($this->agent->referrer());
				return;
			}
			if (@$_SESSION['check_cart_order']['cart_id'] != $this->cart_model->get_sess_cart_items()[0]->cart_item_id && @$_SESSION['check_cart_order']['payment_option'] != $this->cart_model->get_sess_cart_payment_method()->payment_option) {
				// add to tabel transaksi
				$cart_total = $this->cart_model->get_sess_cart_total();		
				$payment_id = $this->input->post('payment_id', true);
				$data_transaction = array(
					'payment_method' => "Saldo",
					'payment_id' => $payment_id,
					'currency' => $cart_total->currency,
					'payment_amount' => $cart_total->total,
					'payment_status' => "payment_received",
				);
				$order_id = $this->order_model->add_order($data_transaction);

				//add order
				$this->session->set_userdata("order_id",$order_id);
				$order = $this->order_model->get_order($order_id);
				if (!empty($order)) {
					//decrease saldo
					$this->order_model->decrease_saldo($order);

					//decrease product quantity after sale
					$this->order_model->decrease_product_quantity_after_sale($order);

					//send email
					if ($this->general_settings->send_email_buyer_purchase == 1) {
						$email_data = array(
							'email_type' => 'new_order',
							'order_id' => $order_id
						);
						$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
					}
				}
			}else{
				$order = $this->order_model->get_order($_SESSION['order_id']);
				//decrease saldo
				$this->order_model->decrease_saldo($order);
				$_SESSION['check_cart_order']['payment_option'] = "saldo";
				$this->db->update("transactions",['payment_method'=>"Saldo",'payment_status'=>"payment_received"],['order_id'=>$order->id]);
				$this->db->update("orders",['payment_method'=>"Saldo",'payment_status'=>"payment_received"],['id'=>$order->id]);
				$this->db->update("order_products",['order_status'=>"order_processing"],['order_id'=>$order->id]);
			}
		}elseif($_POST['payment_option'] == "bank_transfer") {
			if (@$_SESSION['check_cart_order']['cart_id'] != $this->cart_model->get_sess_cart_items()[0]->cart_item_id && @$_SESSION['check_cart_order']['payment_option'] != $this->cart_model->get_sess_cart_payment_method()->payment_option) {				
				// add to tabel transaksi
				$cart_total = $this->cart_model->get_sess_cart_total();				
				$payment_id = $this->input->post('payment_id', true);
				$data_transaction = array(
					'payment_method' => "Bank Transfer",
					'payment_id' => $payment_id,
					'currency' => $cart_total->currency,
					'payment_amount' => $cart_total->total,
					'payment_status' => "awaiting_payment",
				);
				$order_id = $this->order_model->add_order($data_transaction);
				// dd($this->cart_model->get_sess_cart_items())
				// $order_id = $this->order_model->add_order_offline_payment("Bank Transfer");
				$this->session->set_userdata("order_id",$order_id);
				$order = $this->order_model->get_order($order_id);
				if (!empty($order)) {
					//decrease product quantity after sale
					$this->order_model->decrease_product_quantity_after_sale($order);
					//send email
					if ($this->general_settings->send_email_buyer_purchase == 1) {
						$email_data = array(
							'email_type' => 'new_order',
							'order_id' => $order_id
						);
						$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
					}
					$this->session->set_userdata("order_number",$order->order_number);
				}
			}else{
				$this->db->update("transactions",['payment_method'=>"Bank Transfer"],['order_id'=>@$_SESSION['order_id']]);
				$this->db->update("orders",['payment_method'=>"Bank Transfer"],['id'=>@$_SESSION['order_id']]);
			}
		}

		if (!empty($mds_payment_type) && $mds_payment_type == 'promote') {
			$transaction_number = 'bank-' . generate_transaction_number();
			$this->session->set_userdata('mds_promote_bank_transaction_number', $transaction_number);
			redirect(lang_base_url() . "cart/payment?payment_type=promote");
		}
		else {
			redirect(lang_base_url() . "cart/payment");
		}
	}

	/**
	 * Payment
	 */
	public function payment()
	{
		$data['title'] = trans("shopping_cart");
		$data['description'] = trans("shopping_cart") . " - " . $this->app_name;
		$data['keywords'] = trans("shopping_cart") . "," . $this->app_name;
		$data['mds_payment_type'] = 'sale';

		//check guest checkout
		if (empty($this->auth_check) && $this->general_settings->guest_checkout != 1) {
			redirect(lang_base_url() . "cart");
			exit();
		}

		// //check is set cart payment method
		$data['cart_payment_method'] = $this->cart_model->get_sess_cart_payment_method();
		if (empty($data['cart_payment_method'])) {
			redirect(lang_base_url() . "cart/payment-method");
		}

		$payment_type = $this->input->get('payment_type', true);
		if (!empty($payment_type) && $payment_type == 'promote') {
			if ($this->promoted_products_enabled != 1) {
				redirect(lang_base_url());
			}
			$data['mds_payment_type'] = 'promote';
			$data['promoted_plan'] = $this->session->userdata('modesy_selected_promoted_plan');
			if (empty($data['promoted_plan'])) {
				redirect(lang_base_url());
			}
			//total amount
			$data['total_amount'] = $data['promoted_plan']->total_amount;
			$data['currency'] = $this->payment_settings->default_product_currency;
			$data['transaction_number'] = $this->session->userdata('mds_promote_bank_transaction_number');
			$data['cart_total'] = null;
		} else {
			$data['cart_items'] = $this->cart_model->get_sess_cart_items();
			// dd($data['cart_items']);
			if ($data['cart_items'] == null) {
				// dd($data['cart_items']);
				redirect(lang_base_url() . "cart");
			}
			$data['cart_total'] = $this->cart_model->get_sess_cart_total();
			$data["shipping_address"] = $this->cart_model->get_sess_cart_shipping_address();
			$data['cart_has_physical_product'] = $this->cart_model->check_cart_has_physical_product();
			//total amount
			$data['total_amount'] = $data['cart_total']->total;
			$data['currency'] = $this->payment_settings->default_product_currency;
			$data['order'] = $this->order_model->get_order($_SESSION['order_id']);
		}

		//check pagseguro
		if(isset($data['cart_payment_method'])) {
			if ($data['cart_payment_method']->payment_option == 'pagseguro') {
				$this->load->library('pagseguro');
				$data['session_code'] = $this->pagseguro->get_session_code();
			}
		}

		$this->load->view('partials/_header', $data);
		$this->load->view('cart/payment', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Payment with Paypal
	 */
	public function paypal_payment_post()
	{
		$payment_id = $this->input->post('payment_id', true);
		$this->load->library('paypal');

		//validate the order
		if ($this->paypal->get_order($payment_id)) {
			$data_transaction = array(
				'payment_method' => "PayPal",
				'payment_id' => $payment_id,
				'currency' => $this->input->post('currency', true),
				'payment_amount' => $this->input->post('payment_amount', true),
				'payment_status' => $this->input->post('payment_status', true),
			);

			$mds_payment_type = $this->input->post('mds_payment_type', true);
			if ($mds_payment_type == 'sale') {
				//execute sale payment
				$this->execute_sale_payment($data_transaction, 'json_encode');
			} elseif ($mds_payment_type == 'promote') {
				//execute promote payment
				$this->execute_promote_payment($data_transaction, 'json_encode');
			}
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
			$data = array(
				'status' => 0,
				'redirect' => lang_base_url() . "cart/payment/"
			);
			echo json_encode($data);
		}
	}

	/**
	 * Payment with Stripe
	 */
	public function stripe_payment_post()
	{
		require_once(APPPATH . 'third_party/stripe/vendor/autoload.php');
		try {
			$token = $this->input->post('payment_id', true);
			$email = $this->input->post('email', true);
			$payment_amount = $this->input->post('payment_amount', true);
			$currency = $this->input->post('currency', true);
			//Init stripe
			$stripe = array(
				"secret_key" => $this->payment_settings->stripe_secret_key,
				"publishable_key" => $this->payment_settings->stripe_publishable_key,
			);
			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			//customer
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source' => $token
			));
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount' => $payment_amount,
				'currency' => $currency,
				'description' => trans("stripe_checkout")
			));

			//add to database
			$data_transaction = array(
				'payment_method' => "Stripe",
				'payment_id' => $token,
				'currency' => $currency,
				'payment_amount' => price_format_decimal($payment_amount),
				'payment_status' => $this->input->post('payment_status', true),
			);

			$mds_payment_type = $this->input->post('mds_payment_type', true);
			if ($mds_payment_type == 'sale') {
				//execute sale payment
				$this->execute_sale_payment($data_transaction, 'json_encode');
			} elseif ($mds_payment_type == 'promote') {
				//execute promote payment
				$this->execute_promote_payment($data_transaction, 'json_encode');
			}

		} catch (\Stripe\Error\Base $e) {
			$this->session->set_flashdata('error', $e);
			$data = array(
				'status' => 0,
				'redirect' => lang_base_url() . "cart/payment/"
			);
			echo json_encode($data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e);
			$data = array(
				'status' => 0,
				'redirect' => lang_base_url() . "cart/payment/"
			);
			echo json_encode($data);
		}
	}

	/**
	 * Payment with PayStack
	 */
	public function paystack_payment_post()
	{
		$this->load->library('paystack');

		$data_transaction = array(
			'payment_method' => "PayStack",
			'payment_id' => $this->input->post('payment_id', true),
			'currency' => $this->input->post('currency', true),
			'payment_amount' => price_format_decimal($this->input->post('payment_amount', true)),
			'payment_status' => $this->input->post('payment_status', true),
		);

		if (empty($this->paystack->verify_transaction($data_transaction['payment_id']))) {
			$this->session->set_flashdata('error', 'Invalid transaction code!');
			$data = array(
				'status' => 0,
				'redirect' => lang_base_url() . "cart/payment/"
			);
			echo json_encode($data);
			exit();
		}

		$mds_payment_type = $this->input->post('mds_payment_type', true);
		if ($mds_payment_type == 'sale') {
			//execute sale payment
			$this->execute_sale_payment($data_transaction, 'json_encode');
		} elseif ($mds_payment_type == 'promote') {
			//execute promote payment
			$this->execute_promote_payment($data_transaction, 'json_encode');
		}
	}

	/**
	 * Payment with Razorpay
	 */
	public function razorpay_payment_post()
	{
		$this->load->library('razorpay');

		$data_transaction = array(
			'payment_method' => "Razorpay",
			'payment_id' => $this->input->post('payment_id', true),
			'razorpay_order_id' => $this->input->post('razorpay_order_id', true),
			'razorpay_signature' => $this->input->post('razorpay_signature', true),
			'currency' => $this->input->post('currency', true),
			'payment_amount' => price_format_decimal($this->input->post('payment_amount', true)),
			'payment_status' => 'succeeded',
		);

		if (empty($this->razorpay->verify_payment_signature($data_transaction))) {
			$this->session->set_flashdata('error', 'Invalid signature passed!');
			$data = array(
				'status' => 0,
				'redirect' => lang_base_url() . "cart/payment/"
			);
			echo json_encode($data);
			exit();
		}

		$mds_payment_type = $this->input->post('mds_payment_type', true);
		if ($mds_payment_type == 'sale') {
			//execute sale payment
			$this->execute_sale_payment($data_transaction, 'json_encode');
		} elseif ($mds_payment_type == 'promote') {
			//execute promote payment
			$this->execute_promote_payment($data_transaction, 'json_encode');
		}
	}

	/**
	 * Payment with Iyzico
	 */
	public function iyzico_payment_post()
	{
		$token = $this->input->post('token', true);
		$lang_base_url = $this->input->get('lang_base_url', true);

		$options = $this->initialize_iyzico();
		$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		$request->setConversationId("123456");
		$request->setToken($token);

		$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $options);

		if ($checkoutForm->getPaymentStatus() == "SUCCESS") {

			$data_transaction = array(
				'payment_method' => "Iyzico",
				'payment_id' => $token,
				'currency' => $checkoutForm->getCurrency(),
				'payment_amount' => $checkoutForm->getPrice(),
				'payment_status' => "succeeded",
			);

			$mds_payment_type = $this->input->get('payment_type', true);
			if ($mds_payment_type == 'sale') {
				//execute sale payment
				$this->execute_sale_payment($data_transaction, 'direct');
			} elseif ($mds_payment_type == 'promote') {
				//execute promote payment
				$this->execute_promote_payment($data_transaction, 'direct');
			}

		} else {
			echo "sdsd";
			$this->session->set_flashdata('error', trans("msg_error"));
			redirect($lang_base_url . "/cart/payment");
		}
	}

	/**
	 * Payment with PagSeguro
	 */
	public function pagseguro_payment_post()
	{
		$this->load->library('pagseguro');
		$inputs = array(
			'payment_type' => $this->input->post('payment_type', true),
			'token' => htmlspecialchars($this->input->post('token', true)),
			'senderHash' => htmlspecialchars($this->input->post('senderHash', true)),
			'cardNumber' => $this->input->post('cardNumber', true),
			'cardExpiry' => $this->input->post('cardExpiry', true),
			'cardCVC' => $this->input->post('cardCVC', true),
			'total_amount' => $this->input->post('total_amount', true),
			'full_name' => $this->input->post('full_name', true),
			'cpf' => $this->input->post('cpf', true),
			'phone' => $this->input->post('phone', true),
			'email' => $this->input->post('email', true),
			'date_of_birth' => $this->input->post('date_of_birth', true),
			'postal_code' => $this->input->post('postal_code', true),
			'city' => $this->input->post('city', true),
		);

		$result = null;
		$payment_method = 'PagSeguro - Credit Card';
		if ($this->input->post('payment_type', true) == 'credit_card') {
			$result = $this->pagseguro->pay_with_credit_card($inputs);
			if (empty($result)) {
				$this->session->set_flashdata('form_data', $inputs);
				redirect($this->agent->referrer());
			}
		} else {
			$payment_method = 'PagSeguro - Boleto';
			$result = $this->pagseguro->pay_with_boleto($inputs);
			if (empty($result)) {
				$this->session->set_flashdata('form_data', $inputs);
				redirect($this->agent->referrer());
			}
		}

		if (!empty($result->code)) {
			$data_transaction = array(
				'payment_method' => $payment_method,
				'payment_id' => $result->code,
				'currency' => 'BRL',
				'payment_amount' => $inputs['total_amount'],
				'payment_status' => "succeeded",
			);

			$mds_payment_type = $this->input->post('mds_payment_type', true);
			if ($mds_payment_type == 'sale') {
				//execute sale payment
				$this->execute_sale_payment($data_transaction, 'direct');
			} elseif ($mds_payment_type == 'promote') {
				//execute promote payment
				$this->execute_promote_payment($data_transaction, 'direct');
			}
		}
	}

	/**
	 * Payment with Bank Transfer
	 */
	public function bank_transfer_payment_post()
	{
		$mds_payment_type = $this->input->post('mds_payment_type', true);
		// if ($mds_payment_type == 'promote') {
		// 	$promoted_plan = $this->session->userdata('modesy_selected_promoted_plan');
		// 	if (!empty($promoted_plan)) {
		// 		//execute payment
		// 		$this->promote_model->execute_promote_payment_bank($promoted_plan);

		// 		$type = $this->session->userdata('mds_promote_product_type');

		// 		if (empty($type)) {
		// 			$type = "new";
		// 		}
		// 		$transaction_number = $this->session->userdata('mds_promote_bank_transaction_number');
		// 		redirect(lang_base_url() . "promote-payment-completed?method=bank_transfer&transaction_number=" . $transaction_number . "&product_id=" . $promoted_plan->product_id);
		// 	}
		// 	$this->session->set_flashdata('error', trans("msg_error"));
		// 	redirect(lang_base_url() . "/cart/payment");
		// } else {
			
			//Clear Cart
			$this->cart_model->clear_cart();

			$order_id = $_SESSION['order_id'];
			// $order_id = $this->order_model->add_order_offline_payment("Bank Transfer");
			$order = $this->order_model->get_order($order_id);
			if (!empty($order)) {
				if ($order->buyer_id == 0) {
					$this->session->set_userdata('mds_show_order_completed_page', 1);
					redirect(lang_base_url() . "order-completed/" . $order->order_number);
				} else {
					$this->session->set_flashdata('success', trans("msg_order_completed"));
					redirect(lang_base_url() . "order/" . $order->order_number);
				}
			}

			$this->session->set_flashdata('error', trans("msg_error"));
			redirect(lang_base_url() . "/cart/payment");
		// }
	}

	/**
	 * Payment with Saldo
	 */
	public function saldo_payment_post()
	{
		$mds_payment_type = $this->input->post('mds_payment_type', true);

		// add to tabel transaksi
		// $cart_total = $this->cart_model->get_sess_cart_total();		
		// $payment_id = $this->input->post('payment_id', true);
		// $data_transaction = array(
		// 	'payment_method' => "Saldo",
		// 	'payment_id' => $payment_id,
		// 	'currency' => $cart_total->currency,
		// 	'payment_amount' => $cart_total->total,
		// 	'payment_status' => "payment_received",
		// );
		// $order_id = $this->order_model->add_order($data_transaction);

		//add order
		// $order_id = $this->order_model->add_order_offline_payment("Saldo");
		$order_id = $_SESSION['order_id'];
		$order = $this->order_model->get_order($order_id);
		if (!empty($order)) {
			//decrease saldo
			// $this->order_model->decrease_saldo($order);

			//decrease product quantity after sale
			// $this->order_model->decrease_product_quantity_after_sale($order);

			//send email
			// if ($this->general_settings->send_email_buyer_purchase == 1) {
			// 	$email_data = array(
			// 		'email_type' => 'new_order',
			// 		'order_id' => $order_id
			// 	);
			// 	$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
			// }

			if ($order->buyer_id == 0) {
				$this->session->set_userdata('mds_show_order_completed_page', 1);
				redirect(lang_base_url() . "order-completed/" . $order->order_number);
			} else {
				$this->session->set_flashdata('success', trans("msg_order_completed"));
				redirect(lang_base_url() . "order/" . $order->order_number);
			}
		}

		$this->session->set_flashdata('error', trans("msg_error"));
		redirect(lang_base_url() . "/cart/payment");
	}

	/**
	 * Cash on Delivery
	 */
	public function cash_on_delivery_payment_post()
	{
		// add to tabel transaksi
		$cart_total = $this->cart_model->get_sess_cart_total();		
		$payment_id = $this->input->post('payment_id', true);
		$data_transaction = array(
			'payment_method' => "Cash On Delivery",
			'payment_id' => $payment_id,
			'currency' => $cart_total->currency,
			'payment_amount' => $cart_total->total,
			'payment_status' => "payment_received",
		);
		$order_id = $this->order_model->add_order($data_transaction);

		//add order
		// $order_id = $this->order_model->add_order_offline_payment("Cash On Delivery");
		$order = $this->order_model->get_order($order_id);
		if (!empty($order)) {
			//decrease product quantity after sale
			$this->order_model->decrease_product_quantity_after_sale($order);
			//send email
			if ($this->general_settings->send_email_buyer_purchase == 1) {
				$email_data = array(
					'email_type' => 'new_order',
					'order_id' => $order_id
				);
				$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
			}

			if ($order->buyer_id == 0) {
				$this->session->set_userdata('mds_show_order_completed_page', 1);
				redirect(lang_base_url() . "order-completed/" . $order->order_number);
			} else {
				$this->session->set_flashdata('success', trans("msg_order_completed"));
				redirect(lang_base_url() . "order/" . $order->order_number);
			}
		}

		$this->session->set_flashdata('error', trans("msg_error"));
		redirect(lang_base_url() . "/cart/payment");

	}

	/**
	 * Execute Sale Payment
	 */
	public function execute_sale_payment($data_transaction, $redirect_type = 'json_encode')
	{
		//add order
		$order_id = $this->order_model->add_order($data_transaction);
		$order = $this->order_model->get_order($order_id);
		if (!empty($order)) {
			//decrease product quantity after sale
			$this->order_model->decrease_product_quantity_after_sale($order);
			//send email
			if ($this->general_settings->send_email_buyer_purchase == 1) {
				$email_data = array(
					'email_type' => 'new_order',
					'order_id' => $order_id
				);
				$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
			}
			//return json encode response
			if ($redirect_type == 'json_encode') {
				$data = array(
					'result' => 1,
					'redirect' => lang_base_url() . "order/" . $order->order_number
				);
				if ($order->buyer_id == 0) {
					$this->session->set_userdata('mds_show_order_completed_page', 1);
					$data["redirect"] = lang_base_url() . "order-completed/" . $order->order_number;
				} else {
					$this->session->set_flashdata('success', trans("msg_order_completed"));
				}
				echo json_encode($data);
			} else {
				//return direct
				if ($order->buyer_id == 0) {
					$this->session->set_userdata('mds_show_order_completed_page', 1);
					redirect($lang_base_url . "order-completed/" . $order->order_number);
				} else {
					$this->session->set_flashdata('success', trans("msg_order_completed"));
					redirect($lang_base_url . "order/" . $order->order_number);
				}
			}
		} else {
			$this->session->set_flashdata('error', trans("msg_payment_database_error"));
			//return json encode response
			if ($redirect_type == 'json_encode') {
				$data = array(
					'status' => 0,
					'redirect' => lang_base_url() . "cart/payment/"
				);
				echo json_encode($data);
			} else {
				//return direct
				redirect($lang_base_url . "/cart/payment");
			}
		}
	}

	/**
	 * Execute Promote Payment
	 */
	public function execute_promote_payment($data_transaction, $redirect_type = 'json_encode')
	{
		$promoted_plan = $this->session->userdata('modesy_selected_promoted_plan');
		if (!empty($promoted_plan)) {
			//execute payment
			$this->promote_model->execute_promote_payment($data_transaction);
			//add to promoted products
			$this->promote_model->add_to_promoted_products($promoted_plan);

			//reset cache
			reset_cache_data_on_change();
			reset_user_cache_data(user()->id);

			//return json encode response
			if ($redirect_type == 'json_encode') {
				$data = array(
					'result' => 1,
					'redirect' => lang_base_url() . "promote-payment-completed?method=gtw&product_id=" . $promoted_plan->product_id
				);
				echo json_encode($data);
			} else {
				redirect($lang_base_url . "promote-payment-completed?method=gtw&product_id=" . $promoted_plan->product_id);
			}
		} else {
			$this->session->set_flashdata('error', trans("msg_payment_database_error"));
			//return json encode response
			if ($redirect_type == 'json_encode') {
				$data = array(
					'status' => 0,
					'redirect' => lang_base_url() . "/cart/payment?payment_type=promote"
				);
				echo json_encode($data);
			} else {
				$this->session->set_flashdata('error', trans("msg_error"));
				redirect($lang_base_url . "/cart/payment?payment_type=promote");
			}
		}
	}

	/**
	 * Order Completed
	 */
	public function order_completed($order_number)
	{
		$data['title'] = trans("msg_order_completed");
		$data['description'] = trans("msg_order_completed") . " - " . $this->app_name;
		$data['keywords'] = trans("msg_order_completed") . "," . $this->app_name;

		$data['order'] = $this->order_model->get_order_by_order_number($order_number);

		if (empty($data['order'])) {
			redirect(lang_base_url());
		}

		if (empty($this->session->userdata('mds_show_order_completed_page'))) {
			redirect(lang_base_url());
		}

		$this->load->view('partials/_header', $data);
		$this->load->view('cart/order_completed', $data);
		$this->load->view('partials/_footer');
	}

	/**
	 * Promote Payment Completed
	 */
	public function promote_payment_completed()
	{
		$data['title'] = trans("msg_payment_completed");
		$data['description'] = trans("msg_payment_completed") . " - " . $this->app_name;
		$data['keywords'] = trans("payment") . "," . $this->app_name;
		$data['promoted_plan'] = $this->session->userdata('modesy_selected_promoted_plan');
		if (empty($data['promoted_plan'])) {
			redirect(lang_base_url());
		}

		$data["method"] = $this->input->get('method');
		$data["transaction_number"] = $this->input->get('transaction_number');

		$this->load->view('partials/_header', $data);
		$this->load->view('cart/promote_payment_completed', $data);
		$this->load->view('partials/_footer');
	}

}
