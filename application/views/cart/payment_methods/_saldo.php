<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($cart_payment_method->payment_option == "saldo"): ?>
	<!--PRODUCT SALES-->
	<div class="row">
		<div class="col-12">
			<?php $this->load->view('product/_messages'); ?>
		</div>
	</div>
	<?php echo form_open('cart_controller/saldo_payment_post'); ?>
	<input type="hidden" name="mds_payment_type" value="saldo">
	<div id="payment-button-container" class=paypal-button-cnt">
		<div class="bank-account-container">
			<h5>Saldo : <strong><?= print_price($this->auth_user->balance, 'IDR') ?></strong></h5>
			<h5>Total : <strong><?= print_price($cart_total->total, 'IDR') ?></strong></h5>
			<h5>Sisa Saldo : <strong><?= print_price($this->auth_user->balance-$cart_total->total, 'IDR') ?></strong></h5>
		</div><br>
		<p class="p-complete-payment">Saldo Anda akan terpotong sesuai dengan total transaksi yang harus dibayar. Transaksi akan otomatis disetujui oleh sistem.</p>
		<button type="submit" name="submit" value="update" class="btn btn-lg btn-custom float-right"><?php echo trans("place_order") ?></button>
	</div>
	<?php echo form_close(); ?>
<?php endif; ?>



