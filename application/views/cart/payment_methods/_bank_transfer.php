<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($cart_payment_method->payment_option == "bank_transfer"): ?>
	<!--PROMOTE SALES-->
	<?php if ($mds_payment_type == 'promote'): ?>
		<?php if ($cart_payment_method->payment_option == "bank_transfer"): ?>
			<?php echo form_open('cart_controller/bank_transfer_payment_post'); ?>
			<input type="hidden" name="mds_payment_type" value="<?php echo $mds_payment_type; ?>">
			<input type="hidden" name="payment_id" value="<?php echo $transaction_number; ?>">
			<div id="payment-button-container" class=paypal-button-cnt">
				<div class="bank-account-container">
					<?php echo $payment_settings->bank_transfer_accounts; ?>
				</div>

				<p class="p-transaction-number"><span><?php echo trans("transaction_number"); ?>:&nbsp;<?php echo $transaction_number; ?></span></p>

				<p class="p-complete-payment"><?php echo trans("msg_promote_bank_transfer_text"); ?></p>
				<button type="submit" name="submit" value="update" class="btn btn-lg btn-custom float-right"><?php echo trans("place_order") ?></button>
			</div>
			<?php echo form_close(); ?>
		<?php endif; ?>
	<?php else: ?>
		<!--PRODUCT SALES-->
		<div class="row">
			<div class="col-12">
				<?php $this->load->view('product/_messages'); ?>
			</div>
		</div>
		<?php echo form_open('cart_controller/bank_transfer_payment_post'); ?>
		<input type="hidden" name="mds_payment_type" value="<?php echo $mds_payment_type; ?>">
		<div id="payment-button-container" class=paypal-button-cnt">
			<div class="bank-account-container">
				Silahkan membayar tepat <strong><?php echo print_price($cart_total->total, $this->payment_settings->default_product_currency); ?></strong>
				<?php echo $payment_settings->bank_transfer_accounts; ?>
			</div>
			<!-- <p class="p-complete-payment"><?php //echo trans("msg_bank_transfer_text"); ?></p> -->
			<!-- <button type="button" name="konfirmasi_pembayaran" class="btn btn-lg btn-custom float-right ml-1" data-target="#reportPaymentModal" data-toggle="modal"><?php //echo "Konfirmasi Pembayaran" ?></button> -->
			<div class="row float-right">
				<button type="submit" name="submit" value="update" class="btn btn-md btn-custom mr-2"><?php echo trans("order_details") ?></button>
				<?php if(!@$_SESSION['confirm_bank_transfer'] == "done"): ?>
				<button type="button" class="btn btn-md btn-custom" data-toggle="modal" data-target="#infoPaymentModal"><?php echo trans("confirm_payment") ?></button>
				<?php endif ?>
			</div>
		</div>
		<?php echo form_close(); ?>
	<?php endif; ?>
<?php endif; ?>