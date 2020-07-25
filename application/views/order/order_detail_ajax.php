<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div class="row">

    <div class="col-sm-12">
        <div class="row">
            <div class="col-12">
                <!-- include message block -->
                <?php $this->load->view('product/_messages'); ?>
            </div>
        </div>
        <div class="order-details-container">
            <div class="order-head">
                <h2 class="title border-0"><?php echo trans("order"); ?> #<?php echo $order->order_number; ?></h2>
            </div>
            <div class="order-body text-left">
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray small mb-1">Order</p>
                        <h6 class="m-0" style="color: green">#<?php echo $order->order_number; ?></h6>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray small mb-1"><?php echo trans("status"); ?></p>
                        <h6 class="m-0"><?php
                            if ($order_products[0]->order_status == "completed"): ?>
                            <strong style="color: green"><?php echo trans("completed"); ?></strong>
                            <?php elseif($order_products[0]->order_status == "shipped"): ?>
                            <strong style="color: green"><?php echo trans("shipped"); ?></strong>
                            <?php elseif($order_products[0]->order_status == "order_processing"): ?>
                            <strong style="color: orange"><?php echo trans("order_processing"); ?></strong>
                            <?php elseif($order_products[0]->order_status == "awaiting_payment"): ?>
                            <strong style="color: grey"><?php echo trans("awaiting_get_payment"); ?></strong>
                            <?php elseif($order_products[0]->order_status == "cancelled"): ?>
                            <strong style="color: red"><?php echo trans("cancelled"); ?></strong>
                            <?php elseif($order_products[0]->order_status == "payment_received"): ?>
                            <strong style="color: orange"><?php echo trans("awaiting_get_payment"); ?></strong>
                            <?php endif; ?></h6>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray small mb-1"><?php echo trans("payment_status"); ?></p>
                        <?php if($order->payment_status == "awaiting_payment"):?>
                        <h6 class="m-0"><?php echo trans("awaiting_payment"); ?></h6><br>
                        <?php elseif($order->payment_status == "awaiting_verification"):?>
                        <h6 class="m-0"><?php echo trans("awaiting_verification"); ?></h6><br>
                        <?php elseif($order->payment_status == "cancelled"): ?>
                        <h6 class="m-0"><?php echo trans("cancelled"); ?></h6><br>
                        <?php else: ?>
                        <h6 class="m-0"><?php echo trans("payment_received"); ?></h6><br>
                        <?php endif ?>

                        <?php if ($order->payment_method == "Bank Transfer" && $order->payment_status == "awaiting_verification" || $order->payment_status == "awaiting_payment"):
                        
                            if (isset($last_bank_transfer)):?>
                                <?php if ($last_bank_transfer->status == "pending"): ?>
                                    <span class="text-info">(<?php echo trans("pending"); ?>)</span>
                                <?php elseif ($last_bank_transfer->status == "declined"): ?>
                                    <span class="text-danger">(<?php echo trans("bank_transfer_declined"); ?>)</span>
                                    <button type="button" class="btn btn-sm btn-secondary color-white" data-toggle="modal" data-target="#infoPaymentModal"><?php echo trans("transfer_info"); ?></button>
                                <?php endif; ?>
                            <?php else: ?>
                                <button type="button" class="btn btn-sm btn-secondary color-white" data-toggle="modal" data-target="#infoPaymentModal"><?php echo trans("transfer_info"); ?></button>
                            <?php endif; ?>

                        <?php endif; ?>
                        <?php if($order->payment_status == "payment_received" && $order_products[0]->order_status != "completed" && $order_products[0]->order_status != "shipped"):?>
                            <?php if($order->request_cancel == 0 && $order->status_cancel == 0): ?>
                            <button class="btn btn-sm btn-danger m-l-14" data-toggle="modal" data-target="#reportCancelOrder">Ajukan Pembatalan</button>
                            <?php elseif($order->request_cancel == 1 && $order_products[0]->order_status != "order_processing"): ?>
                            <span class="text-danger">(Pengajuan Pembatalan Ditolak)</span>
                            <?php elseif($order->request_cancel == 1): ?>
                            <span class="text-danger">(Sedang Mengajukan Pembatalan)</span>
                            <?php endif ?>
                        <?php endif ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray small mb-1"><?php echo trans("date"); ?></p>
                        <h6 class="m-0"><?php echo $order->created_at; ?></h6>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray small mb-1"><?php echo trans("payment_method"); ?></p>
                        <h6 class="m-0"><?php
                            if ($order->payment_method == "Bank Transfer") {
                                echo trans("bank_transfer");
                            } else {
                                echo $order->payment_method;
                            }
                        ?></h6>
                    </div>
                </div>
                <hr class="my-4" />
                <?php
                $shipping = get_order_shipping($order->id);

                if (!empty($shipping)) : ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <h5 class="mb-3"><?php echo trans("shipping_address"); ?></h5>
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-6 pr-3 mb-3">
                                    <p class="text-gray small mb-1">Nama Lengkap</p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_first_name; ?>
                                    <?php echo $shipping->shipping_last_name; ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("email"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_email; ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("phone_number"); ?></p>
                                    <h6 class="m-0">0<?php echo ltrim($shipping->shipping_phone_number, 0); ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("address"); ?> 1</p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_address_1; ?></h6>
                                </div>
                            </div>
                            <?php if (!empty($shipping->shipping_address_2)): ?>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("address"); ?> 2</p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_address_2; ?></h6>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row no-gutters hidden">
                                <div class="col-auto pr-3 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("country"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_country; ?></h6>
                                </div>
                                <div class="col-auto pr-3 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("state"); ?></p>
                                    <h6 class="m-0">
                                        <?php echo !is_numeric($shipping->shipping_state) ? $shipping->shipping_state :  get_provinsi_id($shipping->shipping_state); ?>
                                        </h6>
                                </div>
                                <div class="col-auto">
                                    <p class="text-gray small mb-1"><?php echo trans("city"); ?></p>
                                    <h5 class="m-0">
                                        <?php echo !is_numeric($shipping->shipping_city) ? $shipping->shipping_city :  get_kota_id($shipping->shipping_city); ?>
                                        </h6>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("zip_code"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->shipping_zip_code; ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3 hidden">
                            <h5 class="mb-3"><?php echo trans("billing_address"); ?></h5>
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-6 pr-3 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("first_name"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->billing_first_name; ?></h6>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p class="text-gray small mb-1"><?php echo trans("last_name"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->billing_last_name; ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("email"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->billing_email; ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("phone_number"); ?></p>
                                    <h6 class="m-0">0<?php echo ltrim($shipping->billing_phone_number, 0); ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("address"); ?> 1</p>
                                    <h6 class="m-0"><?php echo $shipping->billing_address_1; ?></h6>
                                </div>
                            </div>
                            <?php if (!empty($shipping->billing_address_2)): ?>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("address"); ?> 2</p>
                                    <h6 class="m-0"><?php echo $shipping->billing_address_2; ?></h6>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row no-gutters">
                                <div class="col-auto pr-3 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("country"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->billing_country; ?></h6>
                                </div>
                                <div class="col-auto pr-3 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("state"); ?></p>
                                    <h6 class="m-0">
                                        <?php echo !is_numeric($shipping->billing_state) ? $shipping->billing_state : get_provinsi_id($shipping->billing_state); ?>
                                        </h6>
                                </div>
                                <div class="col-auto">
                                    <p class="text-gray small mb-1"><?php echo trans("city"); ?></p>
                                    <h6 class="m-0">
                                        <?php echo !is_numeric($shipping->billing_city) ? $shipping->billing_city : get_kota_id($shipping->billing_city); ?>
                                        </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray small mb-1"><?php echo trans("zip_code"); ?></p>
                                    <h6 class="m-0"><?php echo $shipping->billing_zip_code; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                <?php endif; ?>
                
                <h5 class="mb-4"><?php echo trans("products"); ?></h5>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive modern-table-wrap" id="t_product">
                            <table class="table modern-table m-0" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th style="width: auto"><?php echo trans('product'); ?></th>
                                        <!-- <th style="width: 180px; max-width: 40%"><?php //echo trans('paket'); ?></th> -->
                                        <th style="width: 140px; max-width: 40%"><?php echo trans('updated'); ?></th>
                                        <th style="width: 200px; max-width: 40%"><?php echo trans('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $is_order_has_physical_product = false;
                                    
                                    foreach ($order_products as $item):
                                        $seller = get_user($item->seller_id);

                                        if ($item->product_type == 'physical') {
                                            $is_order_has_physical_product = true;
                                        } ?>
                                        <tr>
                                            <td style="max-width: 40%">
                                                <div class="row no-gutters mb-0">
                                                    <div class="col-auto">
                                                        <a href="<?php echo base_url() . $item->product_slug; ?>" target="_blank">
                                                            <img src="<?php echo get_product_image($item->product_id, 'image_small'); ?>"
                                                                alt="" style="width: 48px; height: auto" />
                                                        </a>
                                                    </div>
                                                    <div class="col pl-3">
                                                        <p class="mb-2"><?php echo html_escape($item->product_title); ?></p>
                                                        <?php if (!empty($seller)): ?>
                                                        <p class="mb-2">
                                                            <span style="margin-right: 4px"><?php echo trans("by"); ?></span>
                                                            <a href="<?php echo base_url(); ?>profile/<?php echo $seller->slug; ?>"
                                                                target="_blank" class="table-product-title">
                                                                <strong><?php echo html_escape($seller->username); ?></strong>
                                                            </a>
                                                        </p>
                                                        <?php endif; ?>
                                                        <div style="max-width: 200px">
                                                            <div class="row no-gutters mb-1">
                                                                <div class="col"><?php echo trans('unit_price'); ?>
                                                                </div>
                                                                <div class="col-auto pl-1">
                                                                    <strong><?php echo print_price($item->product_unit_price, $item->product_currency); ?></strong>
                                                                </div>
                                                            </div>
                                                            <div class="row no-gutters mb-1">
                                                                <div class="col"><?php echo trans('quantity'); ?></div>
                                                                <div class="col-auto pl-1">
                                                                    <strong><?php echo $item->product_quantity; ?></strong>
                                                                </div>
                                                            </div>
                                                            <?php if ($item->product_type == 'physical'): ?>
                                                                <div class="row no-gutters mb-1">
                                                                    <div class="col"><?php echo trans('shipping_cost'); ?>
                                                                    </div>
                                                                    <div class="col-auto pl-1">
                                                                        <strong>
                                                                            <?php echo print_price($item->product_shipping_cost, $item->product_currency); ?>
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="row no-gutters mb-1">
                                                                <div class="col"><?php echo trans('total'); ?></div>
                                                                <div class="col-auto pl-1">
                                                                    <strong><?php echo print_price($item->product_total_price, $item->product_currency); ?></strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($item->product_type == 'digital'): ?>
                                                        <p class="mb-0" style="margin-top: 16px">
                                                            <label class="label bg-black"><i
                                                                    class="icon-cloud-download"></i><?php echo trans("instant_download"); ?></label>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <strong class="no-wrap"><?php// $order_variation[0]->label ?></strong>
                                            </td> -->
                                            <td>
                                                <?php if ($item->product_type == 'physical'):
                                                    echo time_ago($item->updated_at);
                                                endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($item->product_type == 'digital'):
                                                    $digital_sale = get_digital_sale_by_order_id($item->buyer_id, $item->product_id, $item->order_id);
                                                    if (!empty($digital_sale)):?>
                                                        <div class="row-custom">
                                                            <?php echo form_open('file_controller/download_purchased_digital_file'); ?>
                                                            <input type="hidden" name="sale_id" value="<?php echo $digital_sale->id; ?>">
                                                            <div class="btn-group btn-group-download">
                                                                <button type="button" class="btn btn-md btn-custom dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-download-solid"></i><?php echo trans("download"); ?>&nbsp;&nbsp;<i class="icon-arrow-down m-0"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <button name="submit" value="main_files" class="dropdown-item"><?php echo trans("main_files"); ?></button>
                                                                    <button name="submit" value="license_certificate" class="dropdown-item"><?php echo trans("license_certificate"); ?></button>
                                                                </div>
                                                            </div>
                                                            <?php echo form_close(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if ($item->order_status == "completed"): ?>
                                                        <strong class="font-600"><i class="icon-check"></i>&nbsp;<?php echo trans("confirmed"); ?></strong>
                                                    <?php else: ?>
                                                        <?php if ($item->order_status == "shipped"): ?>
                                                            <button type="submit" class="btn btn-sm btn-custom mb-1" data-toggle="modal" data-target="#shippingNote"><i class=""></i><?php echo trans("shipping_seller_note"); ?></button>
                                                            <button type="submit" class="btn btn-sm btn-custom" onclick="approve_order_product('<?php echo $item->id; ?>','<?php echo trans("transfer_info"); ?>');"><i class="icon-check"></i><?php echo trans("confirm_order_received"); ?></button>
                                                            <small class="text-confirm-order-table"><?php echo trans("confirm_order_received_exp"); ?></small>
                                                            <!-- Modal -->
                                                            <div id="shippingNote" class="modal fade" 
                                                                role="dialog" 
                                                                style="z-index: 2 !important;">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Keterangan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php if(isset($order)): ?>
                                                                                <table class="table table-responsive">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Gambar</td>
                                                                                            <td>
                                                                                                <?php if (!empty($order->receipt_path)): ?>
                                                                                                    <a class="magnific-image-popup" href="<?php echo base_url() . $order->receipt_path; ?>" target="_blank">
                                                                                                        <img src="<?php echo base_url() . $order->receipt_path; ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                                                                                    </a>
                                                                                                <?php endif; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Catatan Penjual</td>
                                                                                            <td>
                                                                                                <?php echo $order->shipping_note; ?>
                                                                                            </td>
                                                                                    </tbody>
                                                                                </table>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php if (!empty($item->shipping_tracking_number)): ?>
                                            <tr class="tr-shipping">
                                                <td colspan="4">
                                                    <div class="order-shipping-tracking-number">
                                                        <p><strong><?php echo trans("shipping") ?></strong></p>
                                                        <p><?php echo trans("tracking_number") ?>:&nbsp;<?php echo html_escape($item->shipping_tracking_number); ?>
                                                        </p>
                                                        <p><?php echo trans("url") ?>: <a href="<?php echo html_escape($item->shipping_tracking_url); ?>"
                                                                target="_blank" class="link-underlined"><?php echo html_escape($item->shipping_tracking_url); ?></a>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="tr-shipping-seperator">
                                                <td colspan="4"></td>
                                            </tr>
                                        <?php endif; ?>
                
                                    <?php endforeach; ?>
                
                                </tbody>
                            </table>
                
                            <?php if (empty($order_products)): ?>
                            <p class="text-center">
                                <?php echo trans("no_records_found"); ?>
                            </p>
                            <?php endif; ?>
                            <div class="col-sm-12 table-ft">
                                <div class="row">
                                    <div class="pull-right">
                                        <?php echo $this->pagination->create_links(); ?>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="box-payment-total" style="padding: 15px;background-color: #eee;width: 260px;margin-left: auto">
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 small">
                            <span class=""> <?php echo trans("subtotal"); ?></span>
                        </div>
                        <div class="col-sm-6 small text-left text-sm-right">
                            <strong
                                class="text-right"><?php echo print_price($order->price_subtotal, $order->price_currency); ?></strong>
                        </div>
                    </div>
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 col-right small">
                            <span> Harga per km</span>
                        </div>
                        <div class="col-sm-6 small  text-left text-sm-right">
                            <strong
                                class="font-right"><?= (isset($order_shipping->harga_per_km)) ? print_price($order_shipping->harga_per_km, $order->price_currency) : 'Tidak ada data' ?></strong>
                        </div>
                    </div>
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 col-right small">
                            <span> Total km</span>
                        </div>
                        <div class="col-sm-6 small  text-left text-sm-right">
                            <strong
                                class="font-right"><?= (isset($order_shipping->total_km)) ? $order_shipping->total_km . ' km' : 'Tidak ada data' ?></strong>
                        </div>
                    </div>
                    <?php if ($is_order_has_physical_product): ?>
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 small">
                            <span class=""> <?php echo trans("shipping"); ?></span>
                        </div>
                        <div class="col-sm-6 small text-left text-sm-right">
                            <strong
                                class="text-right"><?php echo print_price($order->price_shipping, $order->price_currency); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                    <hr class="my-2">
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 small">
                            <span class=""> <?php echo trans("total"); ?></span>
                        </div>
                        <div class="col-sm-6 small text-left text-sm-right">
                            <strong class="text-right"><?php echo print_price(($order->price_subtotal + $order->price_shipping), $order->price_currency); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($shipping)): ?>
            <p class="text-confirm-order small">*<?php echo trans("confirm_order_received_warning"); ?></p>
        <?php endif; ?>

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

<!-- Modal -->
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
				<input type="hidden" name="order_number" class="form-control form-input" value="<?php echo $order->order_number; ?>">
				<div class="form-group">
					<label><?php echo trans("payment_note"); ?></label>
					<textarea name="payment_note" class="form-control form-textarea" maxlength="499" autofocus></textarea>
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

<!-- Modal -->
<div class="modal fade" id="reportCancelOrder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<?php echo form_open('order_controller/report_cancel_order'); ?>
			<div class="modal-header">
				<h5 class="modal-title">Pengajuan Pembatalan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="order_number" class="form-control form-input" value="<?php echo $order->order_number; ?>">
				<div class="form-group">
					<label>Catatan Pembatalan</label>
					<textarea name="note_cancel" class="form-control form-textarea" maxlength="499"></textarea>
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