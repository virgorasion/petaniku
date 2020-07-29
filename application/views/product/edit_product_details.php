<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$back_url = lang_base_url() . "sell-now/edit-product/" . $product->id;
if ($product->is_draft == 1) {
	$back_url = lang_base_url() . "sell-now/" . $product->id;
}
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/jquery.dm-uploader.min.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/styles.css"/>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/demo-ui.js"></script>
<script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function (event) {
        window.location.assign('<?php echo $back_url; ?>');
    });
</script>

<!-- Wrapper -->
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div id="content" class="col-12">
				<nav class="nav-breadcrumb" aria-label="breadcrumb">
					<ol class="breadcrumb"></ol>
				</nav>
				<?php if ($product->is_draft == 1): ?>
					<h1 class="page-title page-title-product"><?php echo trans("sell_now"); ?></h1>
					<center>
						<div class="col-md-8">
							<div class="steps">
								<div class="step-progress">
									<div class="step-progress-line" <?= (@$_SESSION['style'] == 2)? 'data-now-value="33"': 'data-now-value="33"' ?> data-number-of-steps="3" <?= (@$_SESSION['style'] == 2)? 'style="width: 66%;"': 'style="width: 100%;"' ?>></div>
								</div>
								<div class="step active">
									<div class="step-icon"><i class="icon-check"></i></div>
									<p>Buat Produk</p>
								</div>
								<div class="step <?= (@$_SESSION['step'] == 2)? 'active' : '' ?>">
									<div class="step-icon"><i class="icon-check"></i></div>
									<p>Detail Produk</p>
								</div>
								<div class="step">
									<div class="step-icon"><i class="icon-check"></i></div>
									<p>Selesai</p>
								</div>
							</div>
						</div>
					</center>
				<?php else: ?>
					<h1 class="page-title page-title-product"><?php echo trans("edit_product"); ?></h1>
				<?php endif; ?>
				<div class="form-add-product">
					<div class="row justify-content-center">
						<div class="col-12 col-md-12 col-lg-11">
							<div class="row">
								<div class="col-12">
									<!-- include message block -->
									<?php $this->load->view('product/_messages'); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">

									<?php if ($product->product_type == 'digital'): ?>
										<div class="row-custom m-b-30">
											<div class="row">
												<div class="col-12">
													<label class="control-label font-600"><?php echo trans("digital_files"); ?></label>
													<small>(<?php echo trans("digital_files_exp"); ?>)</small>
													<?php $this->load->view("product/_digital_files_upload_box"); ?>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<!-- form start -->
									<?php echo form_open_multipart('product_controller/edit_product_details_post', ['id' => 'form_validate', 'class' => 'validate_price', 'class' => 'validate_terms', 'onkeypress' => "return event.keyCode != 13;"]); ?>
									<input type="hidden" name="id" value="<?php echo $product->id; ?>">

									<?php if ($product->product_type == 'digital'): ?>
										<?php $this->load->view("product/license/_license_keys", ['product' => $product, 'license_keys' => $license_keys]); ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('files_included'); ?></h4>
												<small><?php echo trans("files_included_ext"); ?></small>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<input type="text" name="files_included" class="form-control form-input" value="<?php echo html_escape($product->files_included); ?>" placeholder="<?php echo trans("files_included"); ?>" required>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if (!empty($custom_field_array) || ($form_settings->product_conditions == 1 && $product->product_type == 'physical') || ($form_settings->quantity == 1) && $product->product_type == 'physical'): ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans("details"); ?></h4>
											</div>
											<div class="form-box-body">
												<?php if ($product->product_type == 'physical'): ?>
													<div class="form-group">
														<div class="row hidden">
															<?php if ($form_settings->product_conditions == 1) : ?>
																<div class="col-12 col-sm-6 m-b-sm-15">
																	<label class="control-label"><?php echo trans('condition'); ?></label>
																	<?php $product_conditions = get_grouped_product_conditions();
																	if (!empty($product_conditions)): ?>
																		<div class="selectdiv">
																			<select name="product_condition" class="form-control" <?php echo ($form_settings->product_conditions_required == 1) ? 'required' : ''; ?>>
																				<option value=""><?php echo trans('select_option'); ?></option>
																				<?php foreach ($product_conditions as $option):
																					$product_condition = get_product_condition_by_lang($option->common_id, $selected_lang->id); ?>
																					<option value="<?php echo $product_condition->option_key; ?>" <?php echo ($product->product_condition == $product_condition->option_key) ? 'selected' : ''; ?>><?php echo $product_condition->option_label; ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	<?php endif; ?>
																</div>
															<?php endif; ?>

															<?php if ($form_settings->quantity == 1) : ?>
															<?php endif; ?>
														</div>
														<div class="row">
															<div class="col-12 col-sm-6">
																<label class="control-label"><?php echo trans('quantity'); ?> (Total Slot)</label>
																<input type="number" name="quantity" class="form-control form-input" min="1" max="999999" value="<?php echo ($product->quantity > 0) ? html_escape($product->quantity) : ''; ?>" placeholder="<?php echo trans("quantity"); ?>" <?php echo ($form_settings->quantity_required == 1) ? 'required' : ''; ?>>
															</div>
															<div class="col-12 col-sm-6">
																<div class="row">
																	<div class="col-md-6">
																		<label class="control-label">Kepemilikan Bisnis</label>
																		<?php 
																			if(isset($product->luas_lahan)) {
																				$luas_lahan = explode(' ', $product->luas_lahan)[0];
																				$ket_luas = explode(' ', $product->luas_lahan)[1];
																			} else {
																				$luas_lahan = 0;
																				$ket_luas = "";
																			}
																		?>
																		
																		<input type="number" name="luas_lahan" class="form-control form-input" value="<?php echo ($luas_lahan > 0) ? html_escape($luas_lahan) : ''; ?>" placeholder="Total Kepemilikan">					
																	</div>
																	<div class="col-md-6">
																		<label class="control-label">Satuan</label>
																		<select name="ket_luas" class="form-control">
																			<option <?= ($ket_luas == 'Ekor') ? 'selected' : '' ?> value="Ekor">Ekor</option>
																			<option <?= ($ket_luas == 'Hektar') ? 'selected' : '' ?> value="Hektar">Hektar</option>
																			<option <?= ($ket_luas == 'Pohon') ? 'selected' : '' ?> value="Pohon">Pohon</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-12 col-sm-4">
																<label class="control-label">Estimasi Panen (hari)</label>
																<!-- Tolong Diubah bang -->
																<input type="hidden" name="estimasi_panen" id="estimasiPanen">
																<input type="number" class="form-control form-input" name="estimasi_panen_input" onchange="calculatePanen(this.value)" />
																<!-- <input type="date" name="estimasi_panen" class="form-control form-input" onchange="alert(this.value)" value="<?php echo ($product->estimasi_panen) ? \Carbon\Carbon::parse($product->estimasi_panen)->format('yy-m-d') : ''; ?>" placeholder="Estimasi Panen"> -->
																<?php /*
																<input type="hidden" name="estimasi_panen" id="estimasi_panen" value="">
																<select name="estimasi" id="estimasi" class="form-control">
																	<?php for ($i=1; $i < 361; $i++): ?>
																		<option value="<?=$i?>">-<?=$i?> Hari</option>
																	<?php endfor ?>
																</select>
																*/ ?>
																<small id="" class="text-muted">*Estimasi panen dihitung dari tanggal saat ini</small>
															</div>
															<div class="col-12 col-sm-4">																
																<label class="control-label">Keterangan per slot</label>
																<input type="text" name="per_slot" class="form-control form-input" value="<?php echo ($product->per_slot) ? html_escape($product->per_slot) : ''; ?>" placeholder="Per Slot (contoh: 12 buah, 5kg buah, 7 ekor)">
															</div>
															<div class="col-12 col-sm-4">
																<label class="control-label">Harga Per Slot</label>
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
																		<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
																	</div>
																	<input type="text" name="price" id="product_price_input" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
																</div>
															</div>
														</div>
													</div>
												<?php endif; ?>
												<div class="form-group m-0">
													<div class="row" id="custom_fields_container">
														<?php if (isset($custom_field_array)) {
															$this->load->view("product/_custom_fields", ["custom_fields" => $custom_field_array]);
														} ?>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php /*
									<?php if ($product->listing_type == 'sell_on_site'): ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('price'); ?></h4>
											</div>
											<div class="form-box-body">
												<div id="price_input_container" class="form-group">
													<div class="row">
														<div class="col-12 col-sm-6 m-b-sm-15">
															
														</div>
														<div class="col-12 col-sm-6">
															<p class="calculated-price">
																<strong><?php echo trans("you_will_earn"); ?> (<?php echo get_currency($payment_settings->default_product_currency); ?>):&nbsp;&nbsp;
																	<i id="earned_price" class="earned-price">
																		<?php $earned_price = $product->price - (($product->price * $general_settings->commission_rate) / 100);
																		$earned_price = number_format($earned_price, 2, '.', '');
																		echo price_format_input($earned_price); ?>
																	</i>
																</strong>&nbsp;&nbsp;&nbsp;
																<small> (<?php echo trans("commission_rate"); ?>:&nbsp;&nbsp;<?php echo $general_settings->commission_rate; ?>%)</small>
															</p>
														</div>
													</div>
												</div>
												<?php if ($product->product_type == 'digital'): ?>
													<div class="form-group">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="is_free_product" id="checkbox_free_product" <?php echo ($product->is_free_product == 1) ? 'checked' : ''; ?>>
															<label for="checkbox_free_product" class="custom-control-label"><?php echo trans("free_product"); ?></label>
														</div>
													</div>
													<script>
                                                        $(document).on('click', '#checkbox_free_product', function () {
                                                            if ($(this).is(':checked')) {
                                                                $('#price_input_container').hide();
                                                            } else {
                                                                $('#price_input_container').show();
                                                            }
                                                        });
													</script>
												<?php if ($product->is_free_product == 1): ?>
													<style>
														#price_input_container {
															display: none;;
														}
													</style>
												<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
									<?php elseif ($product->listing_type == 'ordinary_listing'):
										if ($form_settings->price == 1): ?>
											<div class="form-box">
												<div class="form-box-head">
													<h4 class="title"><?php echo trans('price'); ?> (tiap slot)</h4>
												</div>
												<div class="form-box-body">
													<div class="form-group">
														<div class="row">
															<?php if ($this->payment_settings->allow_all_currencies_for_classied == 1): ?>
																<div class="col-12 col-sm-4 m-b-sm-15">
																	<div class="selectdiv">
																		<select name="currency" class="form-control" required>
																			<?php $currencies = get_currencies();
																			if (!empty($currencies)):
																				foreach ($currencies as $key => $value):
																					if ($key == $product->currency):?>
																						<option value="<?php echo $key; ?>" selected><?php echo $value["name"] . " (" . $value["hex"] . ")"; ?></option>
																					<?php else: ?>
																						<option value="<?php echo $key; ?>"><?php echo $value["name"] . " (" . $value["hex"] . ")"; ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
																			<?php endif; ?>
																		</select>
																	</div>
																</div>
																<div class="col-12 col-sm-4 m-b-sm-15">
																	<input type="text" name="price" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" <?php echo ($form_settings->price_required == 1) ? 'required' : ''; ?>>
																</div>
															<?php else: ?>
																<div class="col-12 col-sm-6 m-b-sm-15">
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text input-group-text-currency" id="basic-addon2"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
																			<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
																		</div>
																		<input type="text" name="price" id="product_price_input" aria-describedby="basic-addon2" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" <?php echo ($form_settings->price_required == 1) ? 'required' : ''; ?>>
																	</div>
																</div>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php elseif ($product->listing_type == 'bidding'): ?>
										<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
									<?php endif; ?>
									*/ ?>
									<?php if (($product->product_type == 'physical' && $form_settings->physical_demo_url == 1) || ($product->product_type == 'digital' && $form_settings->digital_demo_url == 1)): ?>
										<!-- <div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('demo_url'); ?></h4>
												<small><?php echo trans("demo_url_exp"); ?></small>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<input type="text" name="demo_url" class="form-control form-input" value="<?php echo html_escape($product->demo_url); ?>" placeholder="<?php echo trans("demo_url"); ?>">
												</div>
											</div>
										</div> -->
									<?php endif; ?>

									<div class="row-custom">
										<div class="row">
											<?php if (($product->product_type == 'physical' && $form_settings->physical_video_preview == 1) || ($product->product_type == 'digital' && $form_settings->digital_video_preview == 1)): ?>
												<div class="col-12 col-sm-12 m-b-30">
													<label class="control-label font-600"><?php echo trans("video_preview"); ?></label>
													<small>(<?php echo trans("video_preview_exp"); ?>)</small>
													<?php $this->load->view("product/_video_upload_box"); ?>
												</div>
											<?php endif; ?>
											<?php if (($product->product_type == 'physical' && $form_settings->physical_audio_preview == 1) || ($product->product_type == 'digital' && $form_settings->digital_audio_preview == 1)): ?>
												<!-- <div class="col-12 col-sm-6 m-b-30">
													<label class="control-label font-600"><?php echo trans("audio_preview"); ?></label>
													<small>(<?php echo trans("audio_preview_exp"); ?>)</small>
													<?php
													$audio = $this->file_model->get_product_audio($product->id);
													//$this->load->view("product/_audio_upload_box", ['audio' => $audio]); ?>
												</div> -->
											<?php endif; ?>
										</div>
									</div>

									<?php if ($product->listing_type == 'ordinary_listing'): ?>
										<?php if ($form_settings->external_link == 1): ?>
											<div class="form-box">
												<div class="form-box-head">
													<h4 class="title"><?php echo trans('external_link'); ?></h4>
													<small><?php echo trans("external_link_exp"); ?></small>
												</div>
												<div class="form-box-body">
													<div class="form-group">
														<input type="text" name="external_link" class="form-control form-input" value="<?php echo html_escape($product->external_link); ?>" placeholder="<?php echo trans("external_link"); ?>">
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endif; ?>

									<?php if ($form_settings->variations == 1 && $product->product_type != 'digital'): ?>
										<!-- <div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('variations'); ?></h4>
												<small><?php echo trans('variations_exp'); ?></small>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<div class="row">
														<div id="response_product_variations" class="col-12 m-b-30">
															<?php $this->load->view("product/variation/_response_variations", ["product_variations" => $product_variations]); ?>
														</div>
														<div class="col-12">
															<button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#addVariationModal">
																<?php echo trans("add_variation"); ?>
															</button>
															<button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#variationModalSelect">
																<?php echo trans("select_existing_variation"); ?>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div> -->
									<?php endif; ?>

									<!-- PAKET -->
									<div class="form-box">
										<div class="form-box-head">
											<h4 class="title"><?php echo trans('paket'); ?></h4>
											<small><?php echo trans('paket_exp'); ?></small>
										</div>
										<div class="form-box-body">
											<div class="form-group">
												<div class="row">
													<div id="response_product_variations" class="col-12 m-b-30">
														<?php $this->load->view("product/paket/_list_paket", ["pakets" => $product_variations]); ?>
													</div>
													<div class="col-12">
														<button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#addVariationModal">
															<?php echo trans("add_variation"); ?>
														</button>
														<button type="button" class="btn btn-sm btn-secondary btn-variation hidden" data-toggle="modal" data-target="#variationModalSelect">
															<?php echo trans("select_existing_variation"); ?>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /PAKET -->


									<?php if ($form_settings->shipping == 1 && $product->product_type == 'physical'): ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('shipping'); ?></h4>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<div class="row">
														<div id="response_product_ongkir" class="col-12">
															<?php //$this->load->view("product/ongkir/_list_ongkir", ["ongkirs" => $product_ongkirs]); ?>
oteote
															<?php $this->load->view("product/ongkir/_map_init_ongkir"); ?>
														</div>
														<div class="col-12 hidden">
															<button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#addPengirimanModal">
																Tambah Pengiriman
															</button>
														</div>
													</div>
												</div>
											</div>
											<div class="form-box-body hidden">
												<div class="form-group">
													<div class="row">
														<?php $shipping_options = get_grouped_shipping_options();
														if (!empty($shipping_options)): ?>
															<div class="col-12 col-sm-6 m-b-sm-15">
																<label class="control-label"><?php echo trans('shipping_cost'); ?></label>
																<div class="selectdiv">
																	<select name="shipping_cost_type" class="form-control" onchange="if($(this).find(':selected').attr('data-shipping-cost')==1){$('.shipping-cost-container').show();}else{$('.shipping-cost-container').hide();}" <?php echo ($form_settings->shipping_required == 1) ? 'required' : ''; ?>>
																		<option value=""><?php echo trans("select_option"); ?></option>
																		<?php foreach ($shipping_options as $option):
																			$shipping_option = get_shipping_option_by_lang($option->common_id, $selected_lang->id) ?>
																			<option value="<?php echo $shipping_option->option_key; ?>" data-shipping-cost="<?php echo $shipping_option->shipping_cost; ?>" <?php echo ($product->shipping_cost_type == $shipping_option->option_key) ? 'selected' : ''; ?>><?php echo $shipping_option->option_label; ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>
														<?php endif; ?>
														<div class="col-12 col-sm-6">
															<label class="control-label"><?php echo trans('shipping_time'); ?></label>
															<div class="selectdiv">
																<select name="shipping_time" class="form-control" <?php echo ($form_settings->shipping_required == 1) ? 'required' : ''; ?>>
																	<option value=""><?php echo trans("select_option"); ?></option>
																	<option value="1_business_day" <?php echo ($product->shipping_time == "1_business_day") ? 'selected' : ''; ?>><?php echo trans("1_business_day"); ?></option>
																	<option value="2_3_business_days" <?php echo ($product->shipping_time == "2_3_business_days") ? 'selected' : ''; ?>><?php echo trans("2_3_business_days"); ?></option>
																	<option value="4_7_business_days" <?php echo ($product->shipping_time == "4_7_business_days") ? 'selected' : ''; ?>><?php echo trans("4_7_business_days"); ?></option>
																	<option value="8_15_business_days" <?php echo ($product->shipping_time == "8_15_business_days") ? 'selected' : ''; ?>><?php echo trans("8_15_business_days"); ?></option>
																</select>
															</div>
														</div>
														<div class="col-12 col-sm-6 m-t-15 shipping-cost-container" style="<?php echo ($this->settings_model->is_shipping_option_require_cost($product->shipping_cost_type) == 1) ? 'display:block;' : ''; ?>">
															<label class="control-label"><?php echo trans('shipping_cost'); ?></label>
															<div class="input-group">
																<?php if ($this->payment_settings->default_product_currency != "all"): ?>
																	<div class="input-group-prepend">
																		<span class="input-group-text input-group-text-currency" id="basic-addon3"><?php echo get_currency($this->payment_settings->default_product_currency); ?></span>
																	</div>
																<?php endif; ?>
																<input type="text" name="shipping_cost" aria-describedby="basic-addon3" class="form-control form-input price-input" value="<?php echo ($product->shipping_cost != 0) ? price_format_input($product->shipping_cost) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($form_settings->product_location == 1 && $product->product_type == 'physical'):
										if ($product->country_id == 0) {
											$country_id = $this->auth_user->country_id;
											$state_id = $this->auth_user->state_id;
											$city_id = $this->auth_user->city_id;
											$kecamatan_id = 0;
											$address = $this->auth_user->address;
											$zip_code = $this->auth_user->zip_code;
										} else {
											$country_id = $product->country_id;
											$state_id = $product->state_id;
											$city_id = $product->city_id;
											$kecamatan_id = $product->address;
											$address = $product->address;
											$zip_code = $product->zip_code;
										}
										?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('location'); ?></h4>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<div class="row">
														<?php /*
														<div class="col-12 col-sm-4 m-b-15 hidden">
															<?php if ($general_settings->default_product_location == 0): ?>
																<div class="selectdiv">
																	<select id="countries" name="country_id" class="form-control" onchange="get_states(this.value);" <?php echo ($form_settings->product_location_required == 1) ? 'required' : ''; ?>>
																		<option value=""><?php echo trans('country'); ?></option>
																		<?php foreach ($countries as $item): ?>
																			<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $country_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															<?php else: ?>
																<div class="selectdiv">
																	<select id="countries" name="country_id" class="form-control" required>
																		<?php foreach ($countries as $item): ?>
																			<?php if ($item->id == $general_settings->default_product_location): ?>
																				<option value="<?php echo $item->id; ?>" selected><?php echo html_escape($item->name); ?></option>
																			<?php endif; ?>
																		<?php endforeach; ?>
																	</select>
																</div>
															<?php endif; ?>
														</div>
														*/ ?>
														<input type="hidden" name="country_id" value="102">
														<div class="col-12 col-sm-6 m-b-15">
															<div class="selectdiv">
																<select id="states" name="state_id" class="form-control" onchange="get_cities(this.value);" <?php echo ($form_settings->product_location_required == 1) ? 'required' : ''; ?>>
																	<option value=""><?php echo trans('state'); ?></option>
																	<?php
																	if (!empty($states)):
																		foreach ($states as $item): ?>
																			<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $state_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																		<?php endforeach;
																	endif; ?>
																</select>
															</div>
														</div>
														<div class="col-12 col-sm-6 m-b-15">
															<div class="selectdiv">
																<select id="cities" name="city_id" class="form-control" onchange="get_kecamatan(this.value)">
																	<option value=""><?php echo trans('city'); ?></option>
																	<?php
																	if (!empty($cities)):
																		foreach ($cities as $item): ?>
																			<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $city_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																		<?php endforeach;
																	endif; ?>
																</select>
															</div>
														</div>
														<div class="col-12 hidden">
															<div class="custom-control custom-checkbox custom-control-validate-input">
																<input type="checkbox" class="custom-control-input" name="show_maps" id="show_maps" value="1" <?= ($product->show_maps == 1) ? 'checked': '' ?>>
																<label for="show_maps" class="custom-control-label">Tampilkan Maps di produk</label>
															</div>
														</div>
													</div>

													<div class="row hidden">
														<div class="col-12 col-sm-3">
															<input type="text" name="zip_code" id="zip_code_input" class="form-control form-input" value="<?php echo html_escape($zip_code); ?>" placeholder="<?php echo trans("zip_code") ?>">
														</div>
													</div>
												</div>
												<div class="form-group hidden">
													<div id="map-result">
														<!--load map-->
														<?php
														if ($product->country_id == 0) {
															$this->load->view("product/_load_map", ["map_address" => get_location($this->auth_user)]);
														} else {
															$this->load->view("product/_load_map", ["map_address" => get_location($product)]);
														}
														?>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<div class="form-group m-t-15">
										<div class="custom-control custom-checkbox custom-control-validate-input">
											<?php if ($product->is_draft == 1): ?>
												<input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
											<?php else: ?>
												<input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" checked>
											<?php endif; ?>
											<label for="terms_conditions" class="custom-control-label"><?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
										</div>
									</div>

									<div class="form-group m-t-15">
										<?php if ($product->is_draft == 1): ?>
											<a href="<?php echo lang_base_url(); ?>sell-now/<?php echo $product->id; ?>" class="btn btn-lg btn-custom float-left"><?php echo trans("back"); ?></a>
											<button type="submit" name="submit" value="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("submit"); ?></button>
											<button type="submit" name="submit" value="save_as_draft" class="btn btn-lg btn-secondary color-white float-right m-r-10"><?php echo trans("save_as_draft"); ?></button>
										<?php else: ?>
											<a href="<?php echo lang_base_url(); ?>sell-now/edit-product/<?php echo $product->id; ?>" id="btn_tab_product_images" class="btn btn-lg btn-custom float-left"><?php echo trans("back"); ?></a>
											<button type="submit" name="submit" value="save_changes" class="btn btn-lg btn-custom float-right"><?php echo trans("save_changes"); ?></button>
										<?php endif; ?>
									</div>
									<?php echo form_close(); ?><!-- form end -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Wrapper End-->

<?php $this->load->view("product/paket/_form_paket"); ?>
<?php $this->load->view("product/ongkir/_form_ongkir"); ?>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datepicker/css/bootstrap-datepicker.standalone.css">
<script src="<?php echo base_url(); ?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Plyr JS-->
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.polyfilled.min.js"></script>
<script>
    const player = new Plyr('#player');
    $(document).ajaxStop(function () {
        const player = new Plyr('#player');
    });
    const audio_player = new Plyr('#audio_player');
    $(document).ajaxStop(function () {
        const player = new Plyr('#audio_player');
    });
</script>

<?php if ($product->listing_type == 'sell_on_site'): ?>
	<script>
        //calculate product earned value
        var thousands_separator = '<?php echo $this->thousands_separator; ?>';
        var commission_rate = '<?php echo $this->general_settings->commission_rate; ?>';
        $(document).on("input keyup paste change", "#product_price_input", function () {
            var input_val = $(this).val();
            input_val = input_val.replace(',', '.');
            var price = parseFloat(input_val);
            commission_rate = parseInt(commission_rate);
            //calculate
            if (!Number.isNaN(price)) {
                var earned_price = price - ((price * commission_rate) / 100);
                earned_price = earned_price.toFixed(2);
                if (thousands_separator == ',') {
                    earned_price = earned_price.replace('.', ',');
                }
            } else {
                earned_price = '0' + thousands_separator + '00';
            }
            $("#earned_price").html(earned_price);
        });
	</script>
<?php endif; ?>

<script>
	$("#estimasi").change(function(){
		let d = new Date();
		let get_day = $(this).val();
		d.setDate(d.getDate() + get_day);
		$("#estimasi_panen").val(d);
		console.log(d);
	})
    $('.datepicker').datepicker({
        format: "dd",
    });

	const calculatePanen = days => {
		let dateNow = new Date();
		dateNow.setDate(dateNow.getDate() + parseInt(days));
		let year = dateNow.getFullYear();
		let month = dateNow.getMonth();
		let date = dateNow.getDate();
		$("#estimasiPanen").val(`${year}-${month}-${date}`);
		return days;
	}

</script>
