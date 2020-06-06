<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$shipping = get_order_shipping($order->id);
?>

<style type="text/css">
/** Bootstrap 4 **/
.mb-0 { margin-bottom: 0 !important }
.mb-1 { margin-bottom: 4px !important }
.mb-2 { margin-bottom: 8px !important }
.mb-3 { margin-bottom: 16px !important }
.mb-4 { margin-bottom: 24px !important }
.mb-5 { margin-bottom: 32px !important }

.flex-row {
    display: flex;
}

.flex-row > .col {
    flex-grow: 1;
}

.text-gray {
    color: #767676 !important
}

.order-products-table thead > tr,
.order-products-table tbody > tr:nth-of-type(odd) {
    border-left: none;
    border-right: none;
    border-bottom: none;
    background-color: #fff
}
</style>

<div class="row" style="text-align: left">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title text-center" style="display: block"><?php echo trans("order_details"); ?></h3>
            </div><!-- /.box-header -->

            <div class="box-body">

                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0">Order</p>
                        <h5 class="m-0" style="color: green">#<?php echo $order->order_number; ?></h5>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0"><?php echo trans("status"); ?></p>
                        <h5 class="m-0"><?php
                        if ($order->status == 1): ?>
                            <strong style="color: green"><?php echo trans("completed"); ?></strong>
                        <?php else: ?>
                            <strong style="color: orange"><?php echo trans("order_processing"); ?></strong>
                        <?php
                        endif; ?></h5>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0"><?php echo trans("payment_status"); ?></p>
                        <h5 class="m-0"><?php echo trans($order->payment_status); ?></h5>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0"><?php echo trans("payment_method"); ?></p>
                        <h5 class="m-0"><?php
                            if ($order->payment_method == "Bank Transfer") {
                                echo trans("bank_transfer");
                            } else {
                                echo $order->payment_method;
                            }
                        ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0"><?php echo trans("date"); ?></p>
                        <h5 class="m-0"><?php echo $order->created_at; ?></h5>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <p class="text-gray mb-0"><?php echo trans("payment_method"); ?></p>
                        <h5 class="m-0"><?php
                            if ($order->payment_method == "Bank Transfer") {
                                echo trans("bank_transfer");
                            } else {
                                echo $order->payment_method;
                            }
                        ?></h5>
                    </div>
                </div>
                <hr class="m-0 mb-3" />
                <?php
                if (!empty($shipping)) : ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <h4 class="m-0 mb-3"><?php echo trans("shipping_address"); ?></h4>
                            <div class="flex-row mb-3">
                                <div class="col-auto">
                                    <p class="text-gray mb-0"><?php echo trans("first_name"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_first_name; ?></h4>
                                </div>
                                <div class="col" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("last_name"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_last_name; ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("email"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_email; ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("phone_number"); ?></p>
                                    <h5 class="m-0">0<?php echo ltrim($shipping->shipping_phone_number, 0); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("address"); ?> 1</p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_address_1; ?></h4>
                                </div>
                            </div>
                            <?php if (!empty($shipping->shipping_address_2)): ?>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <p class="text-gray mb-0"><?php echo trans("address"); ?> 2</p>
                                        <h5 class="m-0"><?php echo $shipping->shipping_address_2; ?></h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="flex-row mb-3">
                                <div class="col-auto">
                                    <p class="text-gray mb-0"><?php echo trans("country"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_country; ?></h4>
                                </div>
                                <div class="col-auto" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("state"); ?></p>
                                    <h5 class="m-0"><?php echo !is_numeric($shipping->shipping_state) ? $shipping->shipping_state :  get_provinsi_id($shipping->shipping_state); ?></h4>
                                </div>
                                <div class="col-auto" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("city"); ?></p>
                                    <h5 class="m-0"><?php echo !is_numeric($shipping->shipping_city) ? $shipping->shipping_city :  get_kota_id($shipping->shipping_city); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("zip_code"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->shipping_zip_code; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <h4 class="m-0 mb-3"><?php echo trans("billing_address"); ?></h4>
                            <div class="flex-row mb-3">
                                <div class="col-auto">
                                    <p class="text-gray mb-0"><?php echo trans("first_name"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->billing_first_name; ?></h4>
                                </div>
                                <div class="col" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("last_name"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->billing_last_name; ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("email"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->billing_email; ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("phone_number"); ?></p>
                                    <h5 class="m-0">0<?php echo ltrim($shipping->billing_phone_number, 0); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("address"); ?> 1</p>
                                    <h5 class="m-0"><?php echo $shipping->billing_address_1; ?></h4>
                                </div>
                            </div>
                            <?php if (!empty($shipping->billing_address_2)): ?>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <p class="text-gray mb-0"><?php echo trans("address"); ?> 2</p>
                                        <h5 class="m-0"><?php echo $shipping->billing_address_2; ?></h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="flex-row mb-3">
                                <div class="col-auto">
                                    <p class="text-gray mb-0"><?php echo trans("country"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->billing_country; ?></h4>
                                </div>
                                <div class="col-auto" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("state"); ?></p>
                                    <h5 class="m-0"><?php echo !is_numeric($shipping->billing_state) ? $shipping->billing_state : get_provinsi_id($shipping->billing_state); ?></h4>
                                </div>
                                <div class="col-auto" style="padding-left: 15px">
                                    <p class="text-gray mb-0"><?php echo trans("city"); ?></p>
                                    <h5 class="m-0"><?php echo !is_numeric($shipping->billing_city) ? $shipping->billing_city : get_kota_id($shipping->billing_city); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <p class="text-gray mb-0"><?php echo trans("zip_code"); ?></p>
                                    <h5 class="m-0"><?php echo $shipping->billing_zip_code; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0 mb-3" />
                <?php endif; ?>

                <h4 class="m-0 mb-4"><?php echo trans("products"); ?></h4>
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <div class="table-responsive" id="t_product">
                            <table class="table table-striped order-products-table m-0" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th style="width: auto"><?php echo trans('product'); ?></th>
                                        <th style="width: 140px; max-width: 40%"><?php echo trans('status'); ?></th>
                                        <th style="width: 120px; max-width: 40%"><?php echo trans('updated'); ?></th>
                                        <th style="width: 128px; max-width: 40%"><?php echo trans('options'); ?></th>
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
                                                <div class="flex-row">
                                                    <div class="col-auto">
                                                        <a href="<?php echo base_url() . $item->product_slug; ?>" target="_blank">
                                                            <img src="<?php echo get_product_image($item->product_id, 'image_small'); ?>" alt=""
                                                                style="width: 48px; height: auto" />
                                                        </a>
                                                    </div>
                                                    <div class="col" style="padding-left: 15px">
                                                        <p class="mb-2"><?php echo html_escape($item->product_title); ?></p>
                                                        <?php if (!empty($seller)): ?>
                                                        <p class="mb-2">
                                                            <span style="margin-right: 4px"><?php echo trans("by"); ?></span>
                                                            <a href="<?php echo base_url(); ?>profile/<?php echo $seller->slug; ?>" target="_blank" class="table-product-title">
                                                                <strong><?php echo html_escape($seller->username); ?></strong>
                                                            </a>
                                                        </p>
                                                        <?php endif; ?>
                                                        <div class="flex-row mb-1">
                                                            <div class="col-auto" style="width: 86px"><?php echo trans('unit_price'); ?></div>
                                                            <div class="col">
                                                                <strong><?php echo print_price($item->product_unit_price, $item->product_currency); ?></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-row mb-1">
                                                            <div class="col-auto" style="width: 86px"><?php echo trans('quantity'); ?></div>
                                                            <div class="col">
                                                                <strong><?php echo $item->product_quantity; ?></strong>
                                                            </div>
                                                        </div>
                                                        <?php if ($item->product_type == 'physical'): ?>
                                                        <div class="flex-row mb-1">
                                                            <div class="col-auto" style="width: 86px"><?php echo trans('shipping_cost'); ?></div>
                                                            <div class="col">
                                                                <strong>
                                                                    <?php echo print_price($item->product_shipping_cost, $item->product_currency); ?>
                                                                </strong>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="flex-row mb-1">
                                                            <div class="col-auto" style="width: 86px"><?php echo trans('total'); ?></div>
                                                            <div class="col">
                                                                <strong><?php echo print_price($item->product_total_price, $item->product_currency); ?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($item->product_type == 'digital'): ?>
                                                        <p class="mb-0" style="margin-top: 16px">
                                                            <label class="label bg-black"><i class="icon-cloud-download"></i><?php echo trans("instant_download"); ?></label>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <strong><?php echo trans($item->order_status); ?></strong>
                                                <?php if ($item->buyer_id == 0 && $item->is_approved == 0): ?>
                                                    <br>
                                                    <?php echo form_open('order_admin_controller/approve_guest_order_product'); ?>
                                                    <input type="hidden" name="order_product_id" value="<?php echo $item->id; ?>">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-primary m-t-5"><?php echo trans("approve"); ?></button>
                                                    <?php echo form_close(); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($item->product_type == 'physical'):
                                                    echo time_ago($item->updated_at);
                                                endif; ?>
                                            </td>
                                            <td>
                                                <?php if (($item->product_type == 'digital' && $item->order_status != 'completed') || $item->product_type == 'physical'): ?>
                                                    <a
                                                        href="#"
                                                        class="btn btn-primary btn-block btn-sm mb-2"
                                                        data-toggle="modal"
                                                        data-target="#updateStatusModal_<?php echo $item->id; ?>">
                                                        <span><?php echo trans('update_order_status'); ?></span>
                                                    </a>
                                                    <a
                                                        href="#"
                                                        class="btn btn-block btn-sm border border-primary"
                                                        style="border: 1px solid #0084CE; color: #0084CE"
                                                        data-toggle="modal"
                                                        data-target="#updateTrackingModal_<?php echo $item->id; ?>">
                                                        <span>Update Tracking Number</span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                    
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
                <hr class="m-0 mb-3" />
                <div class="box-payment-total" style="padding: 15px; background-color: #eeeeee; width: 260px">
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 col-right">
                            <strong> <?php echo trans("subtotal"); ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <strong
                                class="font-right"><?php echo print_price($order->price_subtotal, $order->price_currency); ?></strong>
                        </div>
                    </div>
                    <?php if ($is_order_has_physical_product): ?>
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 col-right">
                            <strong> <?php echo trans("shipping"); ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <strong
                                class="font-right"><?php echo print_price($order->price_shipping, $order->price_currency); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                    <hr>
                    <div class="row row-details">
                        <div class="col-xs-12 col-sm-6 col-right">
                            <strong> <?php echo trans("total"); ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <strong class="font-right"><?php echo print_price($order->price_total, $order->price_currency); ?></strong>
                        </div>
                    </div>
                </div>


            </div><!-- /.box-body -->
        </div>
    </div>
</div>

<?php foreach ($order_products as $item): ?>
    <!-- Modal -->
    <div id="updateStatusModal_<?php echo $item->id; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('order_admin_controller/update_order_product_status_post'); ?>
                <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo trans("update_order_status"); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="table-order-status">
                        <div class="form-group">
                            <label class="control-label"><?php echo trans('status'); ?></label>
                            <select name="order_status" class="form-control">
                                <?php if ($item->product_type == 'physical'): ?>
                                    <option value="awaiting_payment"><?php echo trans("awaiting_payment"); ?></option>
                                    <option value="payment_received"><?php echo trans("payment_received"); ?></option>
                                    <option value="order_processing"><?php echo trans("order_processing"); ?></option>
                                    <option value="shipped"><?php echo trans("shipped"); ?></option>
                                <?php endif; ?>
                                <?php if ($item->buyer_id != 0): ?>
                                    <option value="completed"><?php echo trans("completed"); ?></option>
                                <?php endif; ?>
                                <option value="cancelled"><?php echo trans("cancelled"); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><?php echo trans("save_changes"); ?></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans("close"); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
    .sec-title {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        font-weight: 600;
    }

    .font-right {
        font-weight: 600;
        margin-left: 5px;
    }

    .font-right a {
        color: #55606e;
    }

    .row-details {
        margin-bottom: 10px;
    }

    .col-right {
        max-width: 240px;
    }

    .label {
        font-size: 12px !important;
    }

    .box-payment-total {
        width: 400px;
        max-width: 100%;
        float: right;
        background-color: #fff;
        padding: 30px;
    }

    @media (max-width: 768px) {
        .col-right {
            width: 100%;
            max-width: none;
        }

        .col-sm-8 strong {
            margin-left: 0;
        }
    }
</style>


