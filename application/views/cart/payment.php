<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
    $(window).bind("load", function () {
        $("#payment-button-container").css("visibility", "visible");
    });
</script>

<!-- Wrapper -->
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="shopping-cart shopping-cart-shipping">
					<div class="row">
						<div class="col-sm-12 col-lg-7">
							<div class="left">
								<h1 class="cart-section-title"><?php echo trans("checkout"); ?></h1>
								<?php if (!auth_check()): ?>
									<div class="row m-b-15">
										<div class="col-12 col-md-6">
											<p><?php echo trans("checking_out_as_guest"); ?></p>
										</div>
										<div class="col-12 col-md-6">
											<p class="text-right"><?php echo trans("have_account"); ?>&nbsp;<a href="javascript:void(0)" class="link-underlined" data-toggle="modal" data-target="#loginModal"><?php echo trans("login"); ?></a></p>
										</div>
									</div>
								<?php endif; ?>
								<?php if (!empty($cart_has_physical_product)  && $this->form_settings->shipping == 1 && $mds_payment_type != 'promote'): ?>
									<div class="tab-checkout tab-checkout-closed">
										<a href="<?php echo lang_base_url(); ?>cart/shipping"><h2 class=" title">1.&nbsp;&nbsp;<?php echo trans("shipping_information"); ?></h2></a>
										<a href="<?php echo lang_base_url(); ?>cart/shipping" class="link-underlined"><?php echo trans("edit"); ?></a>
									</div>
								<?php endif; ?>

								<div class="tab-checkout tab-checkout-closed">
									<?php if ($mds_payment_type == 'promote'): ?>
										<a href="<?php echo lang_base_url(); ?>cart/payment-method?payment_type=promote"><h2 class=" title">
												<?php if (!empty($cart_has_physical_product) && $mds_payment_type != 'promote') {
													echo '2.';
												} else {
													echo '1.';
												} ?>
												&nbsp;<?php echo trans("payment_method"); ?></h2></a>
										<a href="<?php echo lang_base_url(); ?>cart/payment-method?payment_type=promote" class="link-underlined"><?php echo trans("edit"); ?></a>
									<?php else: ?>
										<a href="<?php echo lang_base_url(); ?>cart/payment-method"><h2 class=" title">
												<?php if (!empty($cart_has_physical_product)  && $this->form_settings->shipping == 1 && $mds_payment_type != 'promote') {
													echo '2.';
												} else {
													echo '1.';
												} ?>
												&nbsp;<?php echo trans("payment_method"); ?></h2></a>
										<a href="<?php echo lang_base_url(); ?>cart/payment-method" class="link-underlined"><?php echo trans("edit"); ?></a>
									<?php endif; ?>
								</div>

								<div class="tab-checkout tab-checkout-open">
									<h2 class="title">
										<?php if (!empty($cart_has_physical_product)  && $this->form_settings->shipping == 1 && $mds_payment_type != 'promote') {
											echo '3.';
										} else {
											echo '2.';
										} ?>&nbsp;
										<?php echo trans("payment"); ?></h2>
									<div class="row">
										<div class="col-12">
											<?php
											$data = array('total_amount' => $total_amount, 'currency' => $currency, 'mds_payment_type' => $mds_payment_type, 'cart_total' => $cart_total);

											if ($cart_payment_method->payment_option == "paypal") {
												$this->load->view("cart/payment_methods/_paypal", $data);
											} elseif ($cart_payment_method->payment_option == "stripe") {
												$this->load->view("cart/payment_methods/_stripe", $data);
											} elseif ($cart_payment_method->payment_option == "paystack") {
												$this->load->view("cart/payment_methods/_paystack", $data);
											} elseif ($cart_payment_method->payment_option == "razorpay") {
												$this->load->view("cart/payment_methods/_razorpay", $data);
											} elseif ($cart_payment_method->payment_option == "iyzico") {
												$this->load->view("cart/payment_methods/_iyzico", $data);
											} elseif ($cart_payment_method->payment_option == "pagseguro") {
												$this->load->view("cart/payment_methods/_pagseguro", $data);
											} elseif ($cart_payment_method->payment_option == "bank_transfer") {
												$this->load->view("cart/payment_methods/_bank_transfer", $data);
											} elseif ($cart_payment_method->payment_option == "cash_on_delivery") {
												$this->load->view("cart/payment_methods/_cash_on_delivery", $data);
											}  elseif ($cart_payment_method->payment_option == "saldo") {
												$this->load->view("cart/payment_methods/_saldo", $data);
											} ?>
										</div>
									</div>
								</div>

							</div>
						</div>

						<?php if ($mds_payment_type == 'promote') {
							$this->load->view("cart/_order_summary_promote");
						} else {
							$this->load->view("cart/_order_summary");
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Wrapper End-->
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
				Silahkan melakukan transfer sebesar <br> <strong><?php echo print_price($order->price_total, $order->price_currency); ?></strong>					
				</h4><br><br>
				<?php echo $payment_settings->bank_transfer_accounts; ?>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-toggle="modal" data-target="#reportPaymentModal"><?php echo trans("report_bank_transfer"); ?></button>				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="reportPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<?php echo form_open_multipart('order_controller/bank_transfer_payment_report_post'); ?>
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("report_bank_transfer"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="order_number" class="form-control form-input" value="<?php echo $_SESSION['order_number']; ?>">
				<div class="form-group">
					<label><?php echo trans("payment_note"); ?></label>
					<textarea name="payment_note" class="form-control form-textarea" maxlength="499"></textarea>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-red" data-dismiss="modal"><?php echo trans("close"); ?></button>
				<button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
			</div>
			<?php echo form_close(); ?><!-- form end -->
		</div>
	</div>
</div>
