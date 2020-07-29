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
        
        <div id="history">
            
        </div>
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
                            <?php echo form_open_multipart('balance_controller/deposit_post'); ?>
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
                                            <input required type="text" onchange="changeSaldo(this)" name="amount" id="product_price_input_deposit" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input " placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" >
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
                                <button onclick="approve_deposit('Anda yakin akan mengisi saldo sebesar ')" type="button" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
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

                <div class="row-custom table-earnings-container" id="table_deposit">
                
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
                            <?php echo form_open('earnings_controller/withdraw_money_post',['id'=>'form_withdraw','class'=>'validate_price']); ?>
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
                                <?php if($user_payout->iban_full_name != "" && $user_payout->iban_bank_name != "" && $user_payout->iban_number != ""): ?>
                                <p><span>Withdraw Account</span>:<br>
                                <span>Nama Lengkap</span>: <?= ($user_payout->iban_full_name == "")? "Kosong": html_escape($user_payout->iban_full_name) ?><br>
                                <span>Nama Bank</span>: <?= ($user_payout->iban_bank_name == "")? "Kosong": html_escape($user_payout->iban_bank_name)  ?><br>
                                <span>Nomor Lengkap</span>: <?= ($user_payout->iban_number == "")? "Kosong": html_escape($user_payout->iban_number)  ?><br>
                                <a href="#" data-toggle="modal" data-target="#akunPayout"><strong>Edit</strong></a></p>

                                <?php else: ?>
                                    <p><span>Belum ada akun withdrawal. </span><a href="#" data-toggle="modal" data-target="#akunPayout"><strong>Tambahkan akun</strong></a></p>
                                <?php endif ?>
                                <button type="button" onclick="submit_withdraw()" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <?php /*
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
                        <div class="col-12 col-md-5">   
                            <div class="minimum-payout-container">
                                <div class="row">
                                    <h2 class="title">Akun Bank Saya: &nbsp;</h2><?= ($user_payout->iban_full_name == "")? "(Tambahkan Akun Bank Anda)": '<button class="btn btn-sm btn-custom" data-toggle="modal" data-target="#akunPayout"> Edit</button>' ?>
                                </div>
                                <p><span>Nama Lengkap</span>:<strong><?= ($user_payout->iban_full_name == "")? "Kosong": html_escape($user_payout->iban_full_name) ?></strong></p>
                                <p><span>Nama Bank</span>:<strong><?= ($user_payout->iban_bank_name == "")? "Kosong": html_escape($user_payout->iban_bank_name)  ?></strong></p>
                                <p><span>Nomor Lengkap</span>:<strong><?= ($user_payout->iban_number == "")? "Kosong": html_escape($user_payout->iban_number)  ?></strong></p>
                            </div>
                        </div>
                        */?>
                    </div>
                </div>

                <div class="row-custom table-earnings-container" id="table_payout">

                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($deposit as $row): 
$transactions = $this->transaction_model->get_transaction_payment_id($row->id);    
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

<div class="modal fade" id="konfirmasiDeposit" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:9999 !important">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
            <?php echo form_open_multipart('balance_controller/deposit_post', ['id' => 'form_validate_payout_1', 'class' => 'deposit_price',]); ?>
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("report_bank_transfer"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
                <div class="form-group">
					<label><?php echo trans("payment_note"); ?></label>
					<textarea name="note" class="form-control form-textarea" maxlength="499"></textarea>
				</div>
				<div class="form-group">
					<label><?php echo trans("receipt"); ?>
						<small>(.png, .jpg, .jpeg)</small>
					</label>
					<p>
						<a class='btn btn-md btn-secondary btn-file-upload'>
							<?php echo trans('select_image'); ?>
							<input type="file" name="file" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info').html($(this).val());">
						</a><br>
						<span class='badge badge-info' id="upload-file-info"></span>
					</p>
				</div>
                <input type="hidden" id="amount_post" name="amount" value="">		
                <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                <input type="hidden" name="kodeunik" value="<?= $uniq?>">		
                <input type="hidden" name="bank_name" value="">		
                <input type="hidden" name="bank_type" value="">		
                <input type="hidden" name="bank_number" value="">		
                <input type="hidden" name="payout_method" value="bank_transfer">		
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-red" data-dismiss="modal"><?php echo trans("close"); ?></button>
				<button type="button" onclick="deposit_post()" class="btn btn-md btn-custom"><?php echo trans("report_bank_transfer"); ?></button>
			</div>
			<?php echo form_close(); ?><!-- form end -->
		</div>
	</div>
</div>

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
				<button type="button" data-toggle="modal" data-target="#konfirmasiDeposit" class="btn btn-sm btn-secondary color-white m-l-15"><?php echo trans("report_bank_transfer"); ?></button>				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="akunPayout" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<div class="modal-header">
				<h5 class="modal-title">Akun Bank Penarikan Uang</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
            <?php echo form_open('earnings_controller/set_iban_payout_account_post'); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 m-b-sm-15">
                            <label><?php echo trans("full_name"); ?>*</label>
                            <input type="text" name="iban_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_full_name); ?>" required>
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

        $(document).on('click','#history a',function(e){
            let url = $(this).attr("href");
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                method: 'get',
                url: url,
                success: function(data) {
                    // var result = JSON.parse(data);
                    $("#history").empty();
                    $("#history").html(data);
                }
            });
        })

        $(document).on('click','#table_deposit a',function(e){
            let url = $(this).attr("href");
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                method: 'get',
                url: url,
                success: function(data) {
                    // var result = JSON.parse(data);
                    $("#table_deposit").empty();
                    $("#table_deposit").html(data);
                }
            });
        })

        $(document).on('click','#table_payout a',function(e){
            let url = $(this).attr("href");
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                method: 'get',
                url: url,
                success: function(data) {
                    // var result = JSON.parse(data);
                    $("#table_payout").empty();
                    $("#table_payout").html(data);
                }
            });
        })
    });

    $.ajax({
        method: 'get',
        url: '<?php echo lang_base_url(); ?>page_history',
        success: function(data) {
            // var result = JSON.parse(data);
            $("#history").html(data);
        }
    });

    $.ajax({
        method: 'get',
        url: '<?php echo lang_base_url(); ?>page_deposit',
        success: function(data) {
            // var result = JSON.parse(data);
            $("#table_deposit").html(data);
        }
    });
    
    $.ajax({
        method: 'get',
        url: '<?php echo lang_base_url(); ?>page_payout',
        success: function(data) {
            // var result = JSON.parse(data);
            $("#table_payout").html(data);
        }
    });
    
    //approve order product
    function approve_deposit(message) {
        if ($("#product_price_input_deposit").val() == "" || parseInt($("#product_price_input_deposit").val()) < 1000) {
            $("#product_price_input_deposit").focus();
            return false;
        }
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
                $("#infoPaymentModal").modal('show');
            }
        });
    };

    function deposit_post(){
        let amount = $("#amount_post").val($("#product_price_input_deposit").val());
        $("#form_validate_payout_1").submit();
    }

    //Submit Withdraw
    function submit_withdraw() {
        let iban_full_name = "<?= $user_payout->iban_full_name ?>";
        let iban_bank_name = "<?= $user_payout->iban_bank_name ?>";
        let iban_number = "<?= $user_payout->iban_number ?>";
        if (iban_full_name == "" && iban_bank_name == "" && iban_number == "") {
            alert("Belum memiliki akun withdrawal");
            $("#akunPayout").modal("show");
        }else{
            swal({
                text: "Anda akan melakukan penarikan saldo akun. Apa anda yakin ?",
                icon: "warning",
                buttons: true,
                buttons: [sweetalert_cancel, sweetalert_ok],
                dangerMode: true,
            }).then(function (approve) {
                if (approve) {
                    $("#form_withdraw").submit();
                }
            });
        }
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