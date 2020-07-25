<?php
$active_classes = 'fade active show';
$digits = 3;
$uniq = rand(pow(10, $digits-1), pow(10, $digits)-1);
?>

<div class="tab-pane <?php echo ($_SESSION['active_tab'] == 'earnings') ? $active_classes : ''; ?>"
    id="tab-content-earnings">
    <div class="order-tab-content">
        <div class="col-12">
            <!-- include message block -->
            <?php $this->load->view('product/_messages'); ?>
        </div>
        <strong class="text-muted">Histori Anda</strong>

        <?php foreach ($hist as $row): ?>
        <div class="card card-history">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php if($row['type'] == "order" || $row['type'] == "terjual"): ?>
                        <a target="_blank" href="<?= base_url('order/'.$row['order_number']) ?>">
                            <span class="text-muted"><?= ucfirst($row['type']) ?> #<?= $row['order_number'] ?></span>                        
                        </a>
                        <?php else: ?>
                        <span class="text-muted"><?= ucfirst($row['type']) ?></span>                                                
                        <?php endif;?>

                        <h5 style="margin-top:10px"><?= $row['title'] ?></h5>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="text-muted">
                            <?php echo \Carbon\Carbon::parse($row['created_at'])->diffForHumans() ?>
                        </div>
                        <div style="margin-top:10px">
                            <?php if($row['sign'] == "min"): ?>
                                <h5 class="text-danger">- <?= print_price($row['amount'], $row['currency']) ?></h5>
                            <?php elseif($row['sign'] == "plus"): ?>
                                <h5 class="text-success">+ <?= print_price($row['amount'], $row['currency']) ?></h5>
                            <?php else: ?>
                                <h5><?= print_price($row['amount'], $row['currency']) ?></h5>                            
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?> 
    </div>
</div>

<div class="tab-pane <?php echo ($_SESSION['active_tab'] == 'deposit') ? $active_classes : ''; ?>"
    id="tab-content-deposit">
    <div class="order-tab-content">
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
                            <h2 class="title">Isi Saldo</h2>
                            <?php echo form_open_multipart('balance_controller/deposit_post', ['id' => 'form_validate_payout_1', 'class' => 'deposit_price',]); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Jumlah Isi Saldo</label>
                                        <?php
                                        $min_value = 0;
                                        if ($payment_settings->payout_paypal_enabled) {
                                            $min_value = $payment_settings->min_payout_paypal;
                                        } elseif ($payment_settings->payout_iban_enabled) {
                                            $min_value = $payment_settings->min_payout_iban;
                                        } elseif ($payment_settings->payout_swift_enabled) {
                                            $min_value = $payment_settings->min_payout_swift;
                                        } ?>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                                <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                            </div>
                                            <input type="text" onchange="changeSaldo(this)" name="amount" id="product_price_input_deposit" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input " placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden">
                                        <label>Jumlah transfer</label>
                                        <!-- <p style="font-weight:800" id="jumlah_transfer"></p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nama Bank Sistem</label>
                                        <input type="text" name="bank_name" class="form-control">
                                        <input type="hidden" name="kodeunik" value="<?= $uniq ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Jenis Bank</label>
                                        <input type="text" name="bank_type" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Nomor</label>
                                        <input type="text" name="bank_number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Metode Pengisian</label>
                                <div class="selectdiv">
                                    <select name="payout_method" class="form-control" onchange="update_payout_input(this.value);" required>
                                        <option value="bank_transfer">Transfer Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label>Bukti Transfer</label><br>
                                <input type="file" name="bukti">
                            </div>
                            <div class="form-group mt-3">
                                <button data-toggle="modal" onclick="approve_deposit('Anda yakin akan mengisi saldo sebesar ')" type="button" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                                <!-- <button type="submit" class="btn btn-md btn-custom"><?php //echo trans("submit"); ?></button> -->
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">   
                        <div class="minimum-payout-container">
                            <h2 class="title">Transfer ke salah satu Bank berikut</h2>
                            <?php echo $payment_settings->bank_transfer_accounts; ?>
                        </div>
                    </div>
                </div>

                <div class="row-custom table-earnings-container">
                    <div class="table-responsive">
                        <table class="table table-orders table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Jumlah Pengisian</th>
                                <th scope="col">Nominal Transfer</th>
                                <th scope="col"><?php echo trans("status"); ?></th>
                                <th scope="col"><?php echo trans("date"); ?></th>
                                <th scope="col"><?php echo trans("options"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($deposit as $row): ?>
                                <tr>
                                    <td><?php echo print_price($row->amount, $row->currency); ?></td>
                                    <td><?php 
                                    $tf = ($row->transfer) ? $row->transfer : $row->amount;
                                    echo print_price($tf, $row->currency); ?></td>
                                    <td>
                                        <?php if ($row->status == 1) {
                                            echo trans("completed");
                                        } else {
                                            echo trans("pending");
                                        } ?>
                                    </td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($row->created_at)); ?></td>
                                    <td>
                                        <?php if($row->status == 0): ?>
                                        <button class="btn btn-md btn-custom" data-toggle="modal" data-target="#infoPaymentModal<?= $row->id ?>">Informasi Transfer</button>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (empty($deposit)): ?>
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

<div class="tab-pane <?php echo ($_SESSION['active_tab'] == 'payouts') ? $active_classes : ''; ?>"
    id="tab-content-payouts">
    <div class="order-tab-content">
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
                            <?php echo form_open('earnings_controller/withdraw_money_post',['class'=>'validate_price']); ?>
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
                                <?php if($user_payout->iban_full_name != "" && $user_payout->iban_country_id != "" && $user_payout->iban_bank_name != "" && $user_payout->iban_number != ""): ?>
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                                <?php endif ?>
                                <a href="#" class="btn btn-md btn-custom" data-toggle="modal" data-target="#akunPayout">
                                    <i class="icon-plus"></i> Tambah akun Pencairan Uang
                                </a>
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

<?php foreach($deposit as $row): 
$transactions = $this->transaction_model->get_transaction($row->id);    
?>
<div class="modal fade" id="infoPaymentModal<?=$row->id?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("transfer_info"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
            <?= form_open("balance_controller/confirmation_deposit"); ?>
				<br><br>
				<h4 class=" text-center">
                <?php if($transactions->payment_status == "awaiting_payment"): ?>
				Silahkan melakukan transfer sebesar <br> <strong><?= "Rp".number_format($row->transfer/100,0,",",".") ?></strong>
                <?php else: ?>
				<span class="text-success">Telah melakukan transfer sebesar</span> <br> <strong><?= "Rp".number_format($row->transfer/100,0,",",".") ?></strong><br><span style="font-size:15px">(Menunggu Konfirmasi Admin)</span>
                <?php endif ?>
				</h4><br><br>
				<?php echo $payment_settings->bank_transfer_accounts; ?>				
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-toggle="modal" data-target="#insertPaymentModal"><?php //echo trans("report_bank_transfer"); ?></button>-->
                <?php if($transactions->payment_status == "awaiting_payment"): ?>
                <input type="hidden" name="id_deposit" value="<?= $row->id?>">
                <input type="hidden" name="payment_amount" value="<?= $row->transfer?>">
				<button type="submit" id="konfirmasi_transfer_deposit" class="btn btn-sm btn-secondary color-white m-l-15"><?php echo trans("report_bank_transfer"); ?></button>
                <?php else: ?>				
				<button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-dismiss="modal"><?php echo trans("close"); ?></button>
                <?php endif ?>
            <?= form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>

<div class="modal fade" id="infoPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("transfer_info"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
				<br><br>
				<h4 class=" text-center">
				Silahkan melakukan transfer sebesar <br> <strong id="jumlah_transfer"></strong>					
				</h4><br><br>
				<?php echo $payment_settings->bank_transfer_accounts; ?>				
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-toggle="modal" data-target="#insertPaymentModal"><?php //echo trans("report_bank_transfer"); ?></button>				 -->
				<button type="button" id="submit_deposit" class="btn btn-sm btn-secondary color-white m-l-15"><?php echo trans("report_bank_transfer"); ?></button>				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="akunPayout" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("transfer_info"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
            <?php echo form_open('earnings_controller/set_iban_payout_account_post'); ?>
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
			<div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('#jumlah_transfer').html(convertToRupiah(0));
    });
    
    //approve order product
    function approve_deposit(message) {
        var kode_unik = <?= $uniq ?>;
        var total = parseInt($("#product_price_input_deposit").val());
        swal({
            text: message + convertToRupiah(total) + " ?",
            icon: "warning",
            buttons: true,
            buttons: [sweetalert_cancel, sweetalert_ok],
            dangerMode: true,
        }).then(function (approve) {
            if (approve) {
                $("#form_validate_payout_1").submit();
            }
        });
    };
    function changeSaldo(that)
    {
        var kode_unik = <?= $uniq ?>;
        var total = parseInt($(that).val()) + kode_unik;
        $('#jumlah_transfer').html(convertToRupiah(total));
    }

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

    function convertToRupiah(angka)
    {
        var rupiah = '';		
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp'+rupiah.split('',rupiah.length-1).reverse().join('');
    }

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