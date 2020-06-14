<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    .card-balance{
        margin-left: 0;
        margin-right: 0;
        background: #4E5FDB;
        color: #FFF;
    }
    .card-history{
        margin-left: 0;
        margin-right: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }
    .text-white {
        color: #FFF !important;        
    }
    .btn-deposit {
        color: #FFF !important;        
        border: 1px solid #FFF;
        text-transform: uppercase;
        font-weight: 800;        
        margin-right: 20px;
    }
    .btn-withdraw {
        background: #FFF;
        color: #4E5FDB !important; 
        text-transform: uppercase;
        font-weight: 800;        
    }
</style>


<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card card-balance">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?= base_url('balances') ?>">
                            <span class="text-muted text-white">Saldo</span>
                            <h3 class="text-white"><?= print_price($this->auth_user->balance, 'IDR') ?></h3>
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <div style="margin-top:10px">
                            <a href="<?= base_url('balances/deposit') ?>" class="btn btn-default btn-lg btn-deposit">
                                Isi Saldo
                            </a>
                            <a href="<?= base_url('balances/payouts') ?>" class="btn btn-default btn-lg btn-withdraw">
                                Pencairan Uang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <div class="row">
        <div class="col-sm-12 col-md-12">
                <?php
                $active_tab = $this->session->flashdata('msg_payout');
                if (empty($active_tab)) {
                    $active_tab = "iban";
                }
                $show_all_tabs = false;
                ?>
                <!-- Nav pills -->
                <ul class="nav nav-pills nav-payout-accounts justify-content-center">
                    <?php if ($payment_settings->payout_paypal_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item hidden">
                            <a class="nav-link nav-link-paypal <?php echo ($active_tab == 'paypal') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_paypal"><?php echo trans("paypal"); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($payment_settings->payout_iban_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item hidden">
                            <a class="nav-link nav-link-bank <?php echo ($active_tab == 'iban') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_iban"><?php echo trans("iban"); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($payment_settings->payout_swift_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-swift <?php echo ($active_tab == 'swift') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_swift"><?php echo trans("swift"); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php $active_tab_content = 'iban'; ?>
                <!-- Tab panes -->
                <?php if ($show_all_tabs): ?>
                    <div class="tab-content">
                        <div class="tab-pane container hidden <?php echo ($active_tab == 'paypal') ? 'active' : 'fade'; ?>" id="tab_paypal">

                            <?php if ($active_tab == "paypal"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_paypal_payout_account_post', ['id' => 'form_validate_payout_1']); ?>
                            <div class="form-group">
                                <label><?php echo trans("paypal_email_address"); ?>*</label>
                                <input type="email" name="payout_paypal_email" class="form-control form-input" value="<?php echo html_escape($user_payout->payout_paypal_email); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane container active" id="tab_iban">

                            <?php if ($active_tab == "iban"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_iban_payout_account_post', ['id' => 'form_validate_payout_2']); ?>
                            <div class="form-group">
                                <label><?php echo trans("full_name"); ?>*</label>
                                <input type="text" name="iban_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_full_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="iban_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->iban_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_name"); ?>*</label>
                                        <input type="text" name="iban_bank_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_bank_name); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("bank_number"); ?>*</label>
                                <input type="text" name="iban_number" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_number); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane container <?php echo ($active_tab == 'swift') ? 'active' : 'fade'; ?>" id="tab_swift">

                            <?php if ($active_tab == "swift"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_swift_payout_account_post', ['id' => 'form_validate_payout_3']); ?>
                            <div class="form-group">
                                <label><?php echo trans("full_name"); ?>*</label>
                                <input type="text" name="swift_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_full_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="swift_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->swift_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("state"); ?>*</label>
                                        <input type="text" name="swift_state" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_state); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("city"); ?>*</label>
                                        <input type="text" name="swift_city" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_city); ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("postcode"); ?>*</label>
                                        <input type="text" name="swift_postcode" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_postcode); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("address"); ?>*</label>
                                <input type="text" name="swift_address" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_address); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("bank_account_holder_name"); ?>*</label>
                                        <input type="text" name="swift_bank_account_holder_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_account_holder_name); ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_name"); ?>*</label>
                                        <input type="text" name="swift_bank_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_name); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("bank_branch_country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="swift_bank_branch_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->swift_bank_branch_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_branch_city"); ?>*</label>
                                        <input type="text" name="swift_bank_branch_city" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_branch_city); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("swift_iban"); ?>*</label>
                                <input type="text" name="swift_iban" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_iban); ?>" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("swift_code"); ?>*</label>
                                <input type="text" name="swift_code" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_code); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

