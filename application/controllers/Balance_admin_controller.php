<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_admin_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check user
        if (!is_admin()) {
            redirect(admin_url() . 'login');
        }
    }

    /**
     * Completed Payouts
     */
    public function completed_deposit()
    {
        $data['title'] = "Deposit";
        $data['form_action'] = admin_url() . "completed-deposit";
        
        //get paginated earnings
        $pagination = $this->paginate(admin_url() . 'completed-deposit', $this->earnings_admin_model->get_completed_deposit_count());
        $data['payouts'] = $this->earnings_admin_model->get_paginated_completed_deposit($pagination['per_page'], $pagination['offset']);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/deposit/completed_deposit', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function deposit_details($id)
    {
        $data['title'] = "Deposit";

        $data['deposit'] = $this->earnings_model->get_deposit_by_id($id);
        $data['transaksi'] = $this->transaction_model->get_deposit_by_order_id($id);
        if (empty($data['deposit'])) {
            show_404();
            return;
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/deposit/deposit_details', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function deposit_requests()
    {
        $data['title'] = "Deposit Request";
        $data['form_action'] = admin_url() . "deposit-requests";
        //get paginated earnings
        $pagination = $this->paginate(admin_url() . 'deposit-requests', $this->earnings_admin_model->get_deposit_requests_count());
        $data['payout_requests'] = $this->earnings_admin_model->get_paginated_deposit_requests($pagination['per_page'], $pagination['offset']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/deposit/deposit_requests', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Complete Payout Request Post
     */
    public function complete_deposit_request_post()
    {
        $payout_id = $this->input->post('payout_id', true);
        $user_id = $this->input->post('user_id', true);
        $amount = $this->input->post('amount', true);

        //check user balance
        if ($this->earnings_admin_model->complete_deposit($payout_id, $user_id, $amount)) {
            $this->earnings_admin_model->complete_deposit_transaction($payout_id, $user_id, $amount);

            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete Payout Post
     */
    public function delete_deposit_post()
    {
        $id = $this->input->post('id', true);
        if ($this->earnings_admin_model->delete_deposit($id)) {
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

}