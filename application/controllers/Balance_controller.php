<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        // if (!is_user_vendor()) {
        //     redirect(lang_base_url());
        // }
        // if (!is_sale_active()) {
        //     redirect(lang_base_url());
        // }
        $this->earnings_per_page = 15;
        $this->user_id = user()->id;
    }

    /**
     * Earnings
     */
    public function balances()
    {
        $data['title'] = 'Saldo';
        $data['description'] = 'Saldo' . " - " . $this->app_name;
        $data['keywords'] = 'Saldo' . "," . $this->app_name;
        $data["active_tab"] = "earnings";
        $this->session->set_flashdata("active_tab","earnings");
        $data['user'] = user();
        
        $pagination = $this->paginate(lang_base_url() . 'earnings', $this->earnings_model->get_earnings_count($this->user_id), $this->earnings_per_page);
        $data['earnings'] = $this->earnings_model->get_paginated_earnings($this->user_id, $pagination['per_page'], $pagination['offset']);
        
        $pagination = $this->paginate(lang_base_url() . 'earnings', $this->earnings_model->get_deposits_count($this->user_id), $this->earnings_per_page);
        $data['deposit'] = $this->earnings_model->get_paginated_deposits($this->user_id, $pagination['per_page'], $pagination['offset']);

        $pagination = $this->paginate(lang_base_url() . 'earnings', $this->earnings_model->get_payouts_count($this->user_id), $this->earnings_per_page);
        $data['payouts'] = $this->earnings_model->get_paginated_payouts($this->user_id, $pagination['per_page'], $pagination['offset']);

        $data['user_payout'] = $this->earnings_model->get_user_payout_account($data['user']->id);

        $hist = $this->earnings_model->get_history($this->user_id);
        $all = [];

        // products
        $products = $this->product_model->get_products();
        $arrProduct = [];
        foreach((array) $products as $prod) {
            $arrProduct[$prod->id] = $prod;
        }

        // users
        $users = $this->user_model->get_users();
        $arrUser = [];
        foreach((array) $users as $r) {
            $arrUser[$r->id] = $r;
        }

        foreach((array) $hist['earnings'] as $earn) {
            $od = $this->order_model->get_order_by_order_number($earn->order_number);
            $prod = $this->order_model->get_order_products($od->id)[0];
            $prod_det = $arrProduct[$prod->product_id];
            
            // 3 Slot "Jagung Manis" - Rp 300.000 - Pak Bambang
            $all[] = [
                'id' => $earn->id,
                'type' => 'terjual',
                'sign' => 'plus',
                'title' => "{$prod->product_quantity} Slot \"{$prod_det->title}\" - " . 
                            return_format_price($earn->earned_amount, $earn->currency) . " - " .
                            $arrUser[$prod_det->user_id]->firstName
                            ,
                'order_number' => $earn->order_number,
                'user_id' => $earn->user_id,
                'amount' => $earn->earned_amount,
                'currency' => $earn->currency,
                'created_at' => $earn->created_at,
                'timestamp' => strtotime($earn->created_at)
            ];
        }

        foreach((array) $hist['deposit'] as $depo) {
            $all[] = [
                'id' => $depo->id,
                'type' => 'deposit',
                'sign' => 'plus',
                'title' => "Deposit " . return_format_price($depo->amount, $depo->currency),
                'order_number' => '',
                'user_id' => $depo->user_id,
                'amount' => $depo->amount,
                'currency' => $depo->currency,
                'created_at' => $depo->created_at,
                'timestamp' => strtotime($depo->created_at)
            ];
        }

        foreach((array) $hist['orders'] as $order) {
            if($order->payment_status == 'awaiting_payment') continue;

            $od = $this->order_model->get_order_by_order_number($order->order_number);
            $prod = $this->order_model->get_order_products($od->id)[0];
            $prod_det = $arrProduct[$prod->product_id];
            
            $all[] = [
                'id' => $order->id,
                'type' => 'order',
                'sign' => ($order->payment_method == "Bank Transfer") ? 'default' : "min",
                'title' => "{$prod->product_quantity} Slot \"{$prod_det->title}\" - " . 
                            return_format_price($order->price_total, $order->price_currency) . " - " .
                            $arrUser[$prod_det->user_id]->firstName
                            ,
                'order_number' => $order->order_number,
                'status' => $order->payment_status,
                'user_id' => $order->buyer_id,
                'amount' => $order->price_total,
                'currency' => $order->price_currency,
                'created_at' => $order->created_at,
                'timestamp' => strtotime($order->created_at)
            ];
        }

        foreach((array) $hist['payouts'] as $pay) {
            $all[] = [
                'id' => $pay->id,
                'type' => 'pencairan uang',
                'sign' => 'min',
                'title' => return_format_price($pay->amount, $pay->currency) . " - " .
                            $arrUser[$prod_det->user_id]->firstName
                            ,
                'order_number' => '',
                'user_id' => $pay->user_id,
                'amount' => $pay->amount,
                'currency' => $pay->currency,
                'created_at' => $pay->created_at,
                'timestamp' => strtotime($pay->created_at)
            ];
        }

        // sort by desc
        if(count($all) > 0) {
            array_multisort(array_column($all, 'timestamp'), SORT_DESC, $all);
        }

        // dd($hist);
        $data['hist'] = $all;

        $this->load->view('partials/_header', $data);
        $this->load->view('balance/balances', $data);
        $this->load->view('partials/_footer');
    }

    public function deposit()
    {
        $data['title'] = "Deposit";
        $data['description'] = "Deposit - " . $this->app_name;
        $data['keywords'] = "Deposit," . $this->app_name;
        $data["active_tab"] = "deposit";
        $this->session->set_flashdata("active_tab","deposit");
        $data['user'] = user();
        
        $pagination = $this->paginate(lang_base_url() . 'earnings', $this->earnings_model->get_deposits_count($this->user_id), $this->earnings_per_page);
        $data['deposit'] = $this->earnings_model->get_paginated_deposits($this->user_id, $pagination['per_page'], $pagination['offset']);

        $this->load->view('partials/_header', $data);
        $this->load->view('balance/deposit', $data);
        $this->load->view('partials/_footer');
    }

    public function deposit_post()
    {
        // dd($this->input->post());
        $this->load->model('upload_model');
        $this->session->set_flashdata("active_tab","deposit");
        $amount = $this->input->post('amount', true);
        $kode = $this->input->post('kodeunik', true);
        $tf = ($amount) + (int) $kode;
        $data = array(
            'user_id' => $this->user_id,
            'amount' => $this->input->post('amount', true),
            'currency' => $this->input->post('currency', true),
            'bank_name' => $this->input->post('bank_name', true),
            'bank_type' => $this->input->post('bank_type', true),
            'bank_number' => $this->input->post('bank_number', true),
            'kodeunik' => $this->input->post('kodeunik', true),
            'transfer' => price_database_format($tf),
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );
        $data["amount"] = price_database_format($data["amount"]);
        $data['note'] = $this->input->post("note",true);
        $temp_path = $this->upload_model->upload_temp_image('file');
		if (!empty($temp_path)) {
            $bukti = $this->upload_model->deposit_image_upload($temp_path, 'deposit');
			$this->upload_model->delete_temp_image($temp_path);
            $data['bukti'] = $bukti;
        }

        $id_deposit = $this->earnings_model->deposit_money($data);

        // add to transaction
        $data_transaction = array(
            'payment_method' => "Deposit",
            'payment_id' => $id_deposit,
            'currency' => $this->input->post('currency', true),
            'payment_amount' => price_database_format($tf),
            'payment_status' => "awaiting_verification",
        );

        $order_id = $this->order_model->add_payment_transaction($data_transaction, $id_deposit);
        $price = "Rp".number_format($tf,0,',','.');

        if (!$id_deposit) {
            $this->session->set_flashdata('error', trans("msg_error"));
        } else {
            $this->session->set_flashdata('success', "Berhasil deposit. Silahkan transfer tepat sebesar $price ");            
        }
        redirect($this->agent->referrer());
    }

    public function confirmation_deposit()
    {
        $id = $this->input->post('id_deposit');
        $price = "Rp".number_format($this->input->post('payment_amount')/100,0,',','.');
        $query = $this->db->update("transactions",['payment_status'=>'awaiting_verification'],['payment_id'=>$id]);
        if ($query) {
            $this->session->set_flashdata('success', "Berhasil konfirmasi pembayaran sebesar $price. Silahkan tunggu konfirmasi dari admin");
        }
        redirect($this->agent->referrer());
    }

    public function upload_bukti_deposit()
    {
        $this->load->model('upload_model');
        $id['id'] = $this->input->post("id_deposit",true);
        $data['note'] = $this->input->post("note",true);
        $temp_path = $this->upload_model->upload_temp_image('file');
		if (!empty($temp_path)) {
            $bukti = $this->upload_model->deposit_image_upload($temp_path, 'deposit');
			$this->upload_model->delete_temp_image($temp_path);
            $data['bukti'] = $bukti;
        }
        if($temp_path != null){
            $this->earnings_model->update_data("transactions",['payment_status'=>'awaiting_verification'],['payment_id'=>$id['id']]);
            $this->session->set_flashdata('success', "Bukti pembayaran berhasil dikirim. Tunggu konfirmasi dari admin terlebih dahulu");
        }else{
            $this->session->set_flashdata('error', "Silahkan Kirim Bukti Pembayaran");
        }
        // Upload Bukti Transfer
        $this->earnings_model->update_data('deposit',$data,$id);
        redirect($this->agent->referrer());
    }

    /**
     * Payouts
     */
    public function payouts()
    {
        $data['title'] = trans("payouts");
        $data['description'] = trans("payouts") . " - " . $this->app_name;
        $data['keywords'] = trans("payouts") . "," . $this->app_name;
        $data["active_tab"] = "payouts";
        $data['user'] = user();
        
        $pagination = $this->paginate(lang_base_url() . 'earnings', $this->earnings_model->get_payouts_count($this->user_id), $this->earnings_per_page);
        $data['payouts'] = $this->earnings_model->get_paginated_payouts($this->user_id, $pagination['per_page'], $pagination['offset']);

        $this->load->view('partials/_header', $data);
        $this->load->view('balance/payouts', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Set Payout Account
     */
    public function set_payout_account()
    {
        $data['title'] = trans("set_payout_account");
        $data['description'] = trans("set_payout_account") . " - " . $this->app_name;
        $data['keywords'] = trans("set_payout_account") . "," . $this->app_name;
        $data["active_tab"] = "set_payout_account";
        $data['user'] = user();
        
        $data['user_payout'] = $this->earnings_model->get_user_payout_account($data['user']->id);

        if (empty($this->session->flashdata('msg_payout'))) {
            if ($this->payment_settings->payout_paypal_enabled) {
                $this->session->set_flashdata('msg_payout', "paypal");
            } elseif ($this->payment_settings->payout_iban_enabled) {
                $this->session->set_flashdata('msg_payout', "iban");
            } elseif ($this->payment_settings->payout_swift_enabled) {
                $this->session->set_flashdata('msg_payout', "swift");
            }
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('balance/set_payout_account', $data);
        $this->load->view('partials/_footer');
    }

}
