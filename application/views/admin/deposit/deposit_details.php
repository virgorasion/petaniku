<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("order_details"); ?></h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h4 class="sec-title">Deposit#<?php echo $deposit->id; ?></h4>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("status"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <?php if ($deposit->status == 1): ?>
                                <label class="label label-success"><?php echo trans("completed"); ?></label>
                                <?php else: ?>
                                <label class="label label-default">
                                <?= cek_status_order($transaksi); ?>                                
                                <?php //echo trans("order_processing"); ?>
                                </label>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row row-details hidden">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("order_id"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo $deposit->id; ?></strong>
                            </div>
                        </div>
                        <div class="row row-details hidden">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("order_number"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo $deposit->id; ?></strong>
                            </div>
                        </div>
                        <div class="row row-details hidden">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("payment_method"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right">
                                    <?php
                                    if ($deposit->payment_method == "Bank Transfer") {
                                        echo trans("bank_transfer");
                                    } else {
                                        echo $deposit->payment_method;
                                    } ?>
                                </strong>
                            </div>
                        </div>
                        <div class="row row-details hidden">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("currency"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo $deposit->price_currency; ?></strong>
                            </div>
                        </div>
                        <div class="row row-details hidden">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("payment_status"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo trans($transaksi->payment_status); ?></strong>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("date"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong
                                    class="font-right"><?php echo $deposit->created_at; ?>&nbsp;(<?php echo time_ago($deposit->created_at); ?>)</strong>
                            </div>
                        </div>
                        <?php /*
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> Bukti Transfer</strong>
                            </div>
                            <div class="col-sm-8">
                                <?php if (!empty($deposit->bukti)): ?>
                                    <a class="magnific-image-popup" href="<?= base_url('uploads/deposit/'.$deposit->bukti) ?>">
                                        <img src="<?= base_url('uploads/deposit/'.$deposit->bukti) ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        */ ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h4 class="sec-title"><?php echo trans("buyer"); ?></h4>
                        <?php $buyer = get_user($deposit->user_id);
                            if (!empty($buyer)):?>
                        <div class="row row-details">
                            <div class="col-xs-12">
                                <div class="table-orders-user">
                                    <a href="<?php echo base_url(); ?>profile/<?php echo $buyer->slug; ?>"
                                        target="_blank">
                                        <img src="<?php echo get_user_avatar($buyer); ?>" alt="" class="img-responsive"
                                            style="height: 120px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("name"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo $buyer->shipping_first_name; ?></strong>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("username"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right">
                                    <a href="<?php echo base_url(); ?>profile/<?php echo $buyer->slug; ?>"
                                        target="_blank">
                                        <?php echo html_escape($buyer->username); ?>
                                    </a>
                                </strong>
                            </div>
                        </div>

                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?php echo trans("email"); ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?php echo $buyer->email; ?></strong>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- /.box-body -->
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box-payment-total">
            <div class="row row-details">
                <div class="col-xs-12 col-sm-6 col-right">
                    <strong> <?php echo trans("total"); ?></strong>
                </div>
                <div class="col-sm-6">
                    <strong
                        class="font-right"><?php echo print_price($deposit->transfer, $deposit->currency); ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($deposit_products as $item): ?>
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
