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
                            <a href="<?= base_url('balances/set-payout-account') ?>" class="btn btn-default btn-lg btn-withdraw">
                                <i class="icon-plus"></i> Tambah akun Pencairan Uang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <!-- include message block -->
                        <?php $this->load->view('product/_messages'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="withdraw-money-container">
                            <h2 class="title"><?php echo trans("withdraw_money"); ?></h2>
                            <?php echo form_open('earnings_controller/withdraw_money_post', ['id' => 'form_validate_payout_1', 'class' => 'validate_price',]); ?>
                            <div class="form-group">
                                <label><?php echo trans("withdraw_amount"); ?></label>
                                <?php
                                $min_value = 0;
                                if ($payment_settings->payout_paypal_enabled) {
                                    $min_value = $payment_settings->min_payout_paypal;
                                } elseif ($payment_settings->payout_iban_enabled) {
                                    $min_value = $payment_settings->min_payout_iban;
                                } elseif ($payment_settings->bank_transfer_enabled) {
                                    $min_value = 0;
                                } elseif ($payment_settings->payout_swift_enabled) {
                                    $min_value = $payment_settings->min_payout_swift;
                                } ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-currency" id="basic-addon2"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                        <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                    </div>
                                    <input type="text" name="amount" value="<?= price_format_input($this->auth_user->balance) ?>" id="product_price_input" aria-describedby="basic-addon2" class="form-control form-input price-input validate-price-input " placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" value="" required readonly>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label><?php echo trans("withdraw_method"); ?></label>
                                <div class="selectdiv">
                                    <select name="payout_method" class="form-control" onchange="update_payout_input(this.value);" required>
                                        <option value="iban" selected><?php echo trans("bank_transfer"); ?></option>
                                        <?php if ($payment_settings->payout_paypal_enabled): ?>
                                            <option value="paypal"><?php echo trans("paypal"); ?></option>
                                        <?php endif; ?>
                                        <?php if ($payment_settings->payout_iban_enabled): ?>
                                            <option value="iban"><?php echo trans("iban"); ?></option>
                                        <?php endif; ?>
                                        <?php if ($payment_settings->payout_swift_enabled): ?>
                                            <option value="swift"><?php echo trans("swift"); ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="minimum-payout-container hidden">
                            <h2 class="title"><?php echo trans("min_poyout_amounts"); ?></h2>
                            <?php if ($payment_settings->bank_transfer_enabled): ?>
                                <p><span><?php echo trans("bank_transfer"); ?></span>:<strong><?php echo print_price(0, $payment_settings->default_product_currency) ?></strong></p>
                            <?php endif; ?>
                            <?php if ($payment_settings->payout_paypal_enabled): ?>
                                <p><span><?php echo trans("paypal"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_paypal, $payment_settings->default_product_currency) ?></strong></p>
                            <?php endif; ?>
                            <?php if ($payment_settings->payout_iban_enabled): ?>
                                <p><span><?php echo trans("iban"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_iban, $payment_settings->default_product_currency) ?></strong></p>
                            <?php endif; ?>
                            <?php if ($payment_settings->payout_swift_enabled): ?>
                                <p><span><?php echo trans("swift"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_swift, $payment_settings->default_product_currency) ?></strong></p>
                            <?php endif; ?>
                            <hr>
                            <?php if (auth_check()): ?>
                                <p><?php echo trans("your_balance"); ?>:<strong><?php echo print_price(user()->balance, $payment_settings->default_product_currency) ?></strong></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row-custom table-earnings-container">
                    <div class="table-responsive">
                        <table class="table table-orders table-striped">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo trans("withdraw_method"); ?></th>
                                <th scope="col"><?php echo trans("withdraw_amount"); ?></th>
                                <th scope="col"><?php echo trans("status"); ?></th>
                                <th scope="col"><?php echo trans("date"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($payouts as $payout): ?>
                                <tr>
                                    <td>Bank Transfer</td>
                                    <td><?php echo print_price($payout->amount, $payout->currency); ?></td>
                                    <td>
                                        <?php if ($payout->status == 1) {
                                            echo trans("completed");
                                        } else {
                                            echo trans("pending");
                                        } ?>
                                    </td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($payout->created_at)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (empty($payouts)): ?>
                        <p class="text-center">
                            <?php echo trans("no_records_found"); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="row-custom m-t-15">
                    <div class="float-right">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    function update_payout_input(option) {
        if (option == "paypal") {
            $('#payout_price_input').attr('min', '<?php echo price_format_decimal($payment_settings->min_payout_paypal); ?>');
        }
        if (option == "iban") {
            $('#payout_price_input').attr('min', '<?php echo price_format_decimal($payment_settings->min_payout_iban); ?>');
        }
        if (option == "swift") {
            $('#payout_price_input').attr('min', '<?php echo price_format_decimal($payment_settings->min_payout_swift); ?>');
        }
        $('#payout_price_input').val('');
    }
</script>

