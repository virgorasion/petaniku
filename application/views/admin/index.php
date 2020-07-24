<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box admin-small-box bg-danger" onclick="scrollKe('#latestProductTable')">
            <div class="inner">
                <h3 class="increase-count"><?php echo $pending_product_count; ?></h3>
                <!-- <a href="<?php echo admin_url(); ?>pending-products"> -->
                <p><?php echo "Product Dalam Moderasi"; ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-low-vision"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box admin-small-box bg-success" onclick="scrollKe('#payoutRequest')">
            <div class="inner">
                <h3 class="increase-count"><?php echo $payout_requests_count; ?></h3>
                    <p><?php echo trans("payout_requests"); ?></p>
            </div>
            <div class="icon">
                    <i class="fa fa-money"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box admin-small-box bg-purple" onclick="scrollKe('#transaksiTable')">
            <div class="inner">
                <h3 class="increase-count"><?php echo $transactions_count; ?></h3>
                    <p><?php echo "Transaksi Menunggu Verifikasi"; ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-basket"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box admin-small-box bg-warning" onclick="scrollKe('#shopOpening')">
            <div class="inner">
                <h3 class="increase-count"><?php echo $shop_req_count; ?></h3>
                    <p><?php echo trans("shop_opening_requests"); ?></p>
            </div>
            <div class="icon">
                    <i class="fa fa-users"></i>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <?php
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime('-6 days'));
    $dates = [];
    $period = new DatePeriod(
        new DateTime($start_date),
        new DateInterval('P1D'),
        new DateTime($end_date)
    );
    foreach ($period as $val) {
        array_push($dates, $val->format('Y-m-d'));
    }
    array_push($dates, $end_date);
    $dates = implode(",", $dates);
    ?>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Report Summary</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <canvas class="w-100" id="report"></canvas>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("shop_opening_request") ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin" id="shopOpening">
                        <thead>
                        <tr>
                            <th><?php echo trans("date"); ?></th>
                            <th><?php echo trans("image"); ?></th>
                            <th><?php echo trans("full_name"); ?></th>
                            <th><?php echo "Persyaratan" ?></th>
                            <th><?php echo trans("options"); ?></th>
                        </tr>
                        </thead>
                        <tbody id="latestOrders">

                        <?php foreach ($seller_registrations as $seller): ?>
                            <tr>
                                <td><?= $seller->created_at ?></td>
                                <td>
                                    <div class="table-orders-user">
                                        <img src="<?php echo get_user_avatar($seller); ?>" alt="buyer"
                                            class="img-responsive" style="height: 50px;">
                                        <span><?php echo html_escape($seller->username); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php echo html_escape($seller->full_name); ?>
                                </td>
                                <td width="25%">
                                    <h6>Foto Ktp</h6>
                                    <a class="magnific-image-popup" href="<?= get_foto_toko($seller->foto_ktp) ?>">
                                        <img src="<?= get_foto_toko($seller->foto_ktp) ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                    </a>
                                    <br><br>

                                    <h6>Foto Selfi</h6>
                                    <a class="magnific-image-popup" href="<?= get_foto_toko($seller->foto_selfi) ?>">
                                        <img src="<?= get_foto_toko($seller->foto_selfi) ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                    </a>
                                </td>
                                <td>
                                    <?php echo form_open('admin_controller/approve_shop_opening_request'); ?>
									<input type="hidden" name="id" value="<?php echo $seller->id; ?>">
									<div class="dropdown">
										<button class="btn bg-purple dropdown-toggle btn-select-option"
												type="button"
												data-toggle="dropdown"><?php echo trans('select_option'); ?>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu options-dropdown">
											<li>
												<button type="submit" name="submit" value="1" class="btn-list-button">
													<i class="fa fa-check option-icon"></i><?php echo trans('approve'); ?>
												</button>
											</li>
											<li>
												<button type="submit" name="submit" value="0" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('decline'); ?>
												</button>
											</li>
										</ul>
									</div>
									<?php echo form_close(); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>verification_account"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Transaksi Menunggu Verifikasi"; ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin" id="transaksiTable">
                        <thead>
                        <tr>
                            <th><?php echo trans("date"); ?></th>
                            <th><?php echo trans("order"); ?></th>
                            <th><?php echo "ID Bank"?></th>
                            <th><?php echo trans('payment_amount'); ?></th>
                            <th><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($latest_transactions as $item): ?>
                            <tr>
                                <td><?php echo date("Y-m-d / h:i", strtotime($item->created_at)); ?></td>
                                <td style="white-space: nowrap">#
                                    <?php
                                        if($item->payment_method == "Deposit") {
                                            $deposit = $this->earnings_model->get_deposit_by_id($item->order_id);
                                            echo 'Deposit (# <a href="'. admin_url() .'deposit-details/'. html_escape($deposit->id) .'">'. $deposit->id .')</a>';
                                        } else {
                                            $order = $this->order_admin_model->get_order($item->order_id);
                                            echo 'Pesanan (# <a href="'. admin_url() .'order-details/'. html_escape($item->order_id) .'">'. $order->order_number .')</a>';
                                        }
                                    ?>
                                </td>
                                <?php if(isset($order)): ?>
                                    <?php
                                        $bank_tf = $this->order_admin_model->get_bank_transfer_by_order_number($order->order_number);
                                        if(isset($bank_tf)):
                                    ?>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#accountDetailsModel_<?php echo $item->id; ?>"><?php echo trans("see_details"); ?></button>                                    
                                    </td>
                                    <?php else: ?>
                                    <td>-
                                    </td>
                                    <?php endif; ?>
                                <?php elseif($deposit): ?>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#accountDetailsDepositModel_<?php echo $deposit->id; ?>"><?php echo trans("see_details"); ?></button>                                    
                                    </td>                                
                                <?php else: ?>
                                    <td>
                                    </td>                                
                                <?php endif; ?>
                                <td>
                                    <?php
                                        echo print_price($item->payment_amount, $item->currency); 
                                    ?>
                                </td>
                                <?php if($item->payment_method != "Deposit"):?>
                                    <td>
                                        <?php 
                                        $order = $this->order_admin_model->get_order($item->order_id);
                                        if(!isset($order)) continue;
                                        $bank_tf = $this->order_admin_model->get_bank_transfer_by_order_number($order->order_number);  
                                        if(isset($bank_tf)):                                  
                                        echo form_open_multipart('order_admin_controller/bank_transfer_options_post'); ?>
                                        <input type="hidden" name="id" value="<?php echo $bank_tf->id; ?>">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                    type="button"
                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <?php if ($bank_tf->status == 'pending'):
                                                    if (!empty($order)): ?>
                                                        <li>
                                                            <a href="javascript:void(0)" onclick="approve_bank_transfer('<?php echo $bank_tf->id; ?>','<?php echo $order->id; ?>','<?php echo trans("msg_accept_bank_transfer"); ?>');"><i class="fa fa-check option-icon"></i><?php echo trans('approve'); ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <button type="submit" name="option" value="declined" class="btn-list-button">
                                                            <i class="fa fa-times option-icon"></i><?php echo trans('decline'); ?>
                                                        </button>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="delete_item('order_admin_controller/delete_bank_transfer_post','<?php echo $bank_tf->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php echo form_close(); endif ?>
                                    </td>
                                <?php else:
                                    $deposit = $this->earnings_model->get_deposit_by_id($item->order_id);
                                    if(!isset($deposit)) continue; ?>
                                <td>
                                    <?php echo form_open_multipart('balance_admin_controller/complete_deposit_request_post'); ?>
                                    <input type="hidden" name="payout_id" value="<?php echo $deposit->id; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $deposit->user_id; ?>">
                                    <input type="hidden" name="amount" value="<?php echo $deposit->amount; ?>">
                                    
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <?php if ($deposit->status == 0): ?>
                                            <li>
                                                <button type="submit" name="option" value="completed" class="btn-list-button">
                                                    <i class="fa fa-check option-icon"></i><?php echo trans('completed'); ?>
                                                </button>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('balance_admin_controller/delete_deposit_post','<?php echo $deposit->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php echo form_close(); ?>
                                </td>
                                <?php endif ?>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>transactions"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Produk Dalam Moderasi" ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin" id="latestProductTable">
                        <thead>
                        <tr>
                            <th><?php echo trans("id"); ?></th>
                            <th><?php echo trans("name"); ?></th>
                            <th><?php echo trans("options"); ?></th>
                        </tr>
                        </thead>
                        <tbody id="latestProducts">

                        <?php foreach ($latest_pending_products as $item): ?>
                            <tr>
                                <td style="width: 10%"><?php echo html_escape($item->id); ?></td>
                                <td class="index-td-product">
                                    <img src="<?php echo get_product_image($item->id, 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
                                    <?php echo html_escape($item->title); ?>
                                </td>
                                <td style="width: 10%">
                                    <div class="dropdown">
										<button class="btn bg-purple dropdown-toggle btn-select-option"
												type="button"
												data-toggle="dropdown"><?php echo trans('select_option'); ?>
											<span class="caret"></span>
										</button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <li>
                                                <a href="javascript:void(0)" onclick="approve_product('<?php echo $item->id; ?>');"><i class="fa fa-check option-icon"></i><?php echo trans('approve'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="decline_product('<?php echo $item->id; ?>');"><i class="fa fa-times option-icon"></i><?php echo trans('decline'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>products"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Permintaan Pencairan Uang"; ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin" id="payoutRequest">
                        <thead>
                        <tr>
                            <th><?php echo trans("date"); ?></th>
                            <th><?php echo trans("user"); ?></th>
                            <th><?php echo trans("withdraw_method"); ?></th>
                            <th><?php echo trans("withdraw_amount"); ?></th>
                            <th><?php echo trans("options"); ?></th>
                        </tr>
                        </thead>
                        <tbody id="latestPendingProducts">

                        <?php foreach ($latest_payout as $item): ?>
                        
                            <tr>
                                <td><?php echo $item->created_at; ?></td>
                                <td>
                                    <?php $user = get_user($item->user_id);
                                    if (!empty($user)):?>
                                        <div class="table-orders-user">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $user->slug; ?>" target="_blank">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="buyer" class="img-responsive" style="height: 50px;">
                                                <?php echo html_escape($user->username); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php //echo trans($item->payout_method); ?>
                                    <p class="m-0">
                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#accountDetailsModel_<?php echo $item->id; ?>"><?php echo trans("see_details"); ?></button>
                                    </p>
                                </td>
                                <td><?php echo print_price($item->amount, $item->currency); ?></td>
                                <td>
                                    <?php echo form_open_multipart('earnings_admin_controller/complete_payout_request_post'); ?>
                                    <input type="hidden" name="payout_id" value="<?php echo $item->id; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $item->user_id; ?>">
                                    <input type="hidden" name="amount" value="<?php echo $item->amount; ?>">

                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <?php if($item->status == 0): ?>
                                            <li>
                                                <button type="submit" name="option" value="completed" class="btn-list-button">
                                                    <i class="fa fa-check option-icon"></i><?php echo trans('completed'); ?>
                                                </button>
                                            </li>
                                            <?php endif ?>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('earnings_admin_controller/delete_payout_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php echo form_close(); ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>payout-requests"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("latest_transactions"); ?>&nbsp;<small style="font-size: 13px;">(<?php echo trans("promoted_products"); ?>)</small>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th><?php echo trans("id"); ?></th>
                            <th><?php echo trans('payment_method'); ?></th>
                            <th><?php echo trans("payment_amount"); ?></th>
                            <th><?php echo trans('status'); ?></th>
                            <th><?php echo trans("date"); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($latest_promoted_transactions as $item): ?>
                            <tr>
                                <td style="width: 10%"><?php echo html_escape($item->id); ?></td>
                                <td>
                                    <?php
                                    if ($item->payment_method == "Bank Transfer") {
                                        echo trans("bank_transfer");
                                    } else {
                                        echo $item->payment_method;
                                    } ?>
                                </td>
                                <td><?php echo print_preformatted_price($item->payment_amount, $item->currency); ?></td>
                                <td><?php echo trans($item->payment_status); ?></td>
                                <td><?php echo date("Y-m-d / h:i", strtotime($item->created_at)); ?></td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>promoted-products-transactions"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("latest_product_reviews"); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th><?php echo trans("id"); ?></th>
                            <th><?php echo trans("name"); ?></th>
                            <th style="width: 60%"><?php echo trans("review"); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($latest_reviews as $item): ?>
                            <tr>
                                <td style="width: 10%"><?php echo html_escape($item->id); ?></td>
                                <td style="width: 25%" class="break-word">
                                    <?php echo html_escape($item->user_username); ?>
                                </td>
                                <td style="width: 65%" class="break-word">
                                    <div>
                                        <?php $this->load->view('admin/includes/_review_stars', ['review' => $item->rating]); ?>
                                    </div>
                                    <?php echo character_limiter($item->review, 100); ?>
                                    <div class="table-sm-meta">
                                        <?php echo time_ago($item->created_at); ?>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>product-reviews"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="box box-primary box-sm">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("latest_comments"); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body index-table">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th><?php echo trans("date"); ?></th>
                            <th><?php echo trans("name"); ?></th>
                            <th style="width: 60%"><?php echo trans("comment"); ?></th>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($latest_comments as $item): ?>
                            <tr>
                                <td style="width: 10%"><?php echo time_ago($item->created_at); ?></td>
                                <td style="width: 25%" class="break-word">
                                    <?php echo html_escape($item->name); ?>
                                </td>
                                <td style="width: 65%" class="break-word">
                                    <?php echo character_limiter($item->comment, 100); ?>
                                    <div class="table-sm-meta">
                                        <?php echo time_ago($item->created_at); ?>
                                    </div>
                                </td>
                                <td>
                                
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo admin_url(); ?>product-comments"
                   class="btn btn-sm btn-default pull-right"><?php echo trans("view_all"); ?></a>
            </div>
        </div>
    </div>

    <div class="no-padding margin-bottom-20">
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <!-- USERS LIST -->
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo trans("latest_members"); ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="users-list clearfix">

                        <?php foreach ($latest_members as $item) : ?>
                            <li>
                                <a href="<?php echo base_url(); ?>profile/<?php echo $item->slug; ?>">
                                    <img src="<?php echo get_user_avatar($item); ?>" alt="user" class="img-responsive">
                                </a>
                                <a href="<?php echo base_url(); ?>profile/<?php echo $item->slug; ?>" class="users-list-name"><?php echo html_escape($item->username); ?></a>
                                <span class="users-list-date"><?php echo time_ago($item->created_at); ?></span>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="<?php echo admin_url(); ?>members" class="btn btn-sm btn-default btn-flat pull-right"><?php echo trans("view_all"); ?></a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
</div>

<?php foreach ($latest_transactions as $item):
    $order = $this->order_admin_model->get_order($item->order_id);
    if(!isset($order)) continue;
    $bank_tf = $this->order_admin_model->get_bank_transfer_by_order_number($order->order_number);
    ?>
    <!-- Modal -->
    <div id="accountDetailsModel_<?php echo $item->id; ?>" class="modal fade" 
        role="dialog" 
        style="z-index: 999999 !important;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transfer Bank</h4>
                </div>
                <div class="modal-body">
                    <?php if(isset($bank_tf)): ?>
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td><?php echo trans('date'); ?></td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($bank_tf->created_at)); ?></td>                                    
                                </tr>
                                <tr>
                                    <td><?php echo trans('receipt'); ?></td>
                                    <td>
                                        <?php if (!empty($bank_tf->receipt_path)): ?>
                                            <a class="magnific-image-popup" href="<?php echo base_url() . $bank_tf->receipt_path; ?>">
                                                <img src="<?php echo base_url() . $bank_tf->receipt_path; ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo trans('payment_note'); ?></td>
                                    <td>
                                        <?php echo $bank_tf->payment_note; ?>
                                    </td>
                                </tr>
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
<?php endforeach; ?>


<?php foreach ($latest_transactions as $item):
    if($item->payment_method != "Deposit") continue;
    $deposit = $this->earnings_model->get_deposit_by_id($item->order_id);    
    if(!isset($deposit)) continue;

    ?>
    <!-- Modal -->
    <div id="accountDetailsDepositModel_<?php echo $deposit->id; ?>" class="modal fade" 
        role="dialog" 
        style="z-index: 999999 !important;">
        <div class="modal-dialog" style="margin-top:120px">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transfer Bank</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td><?php echo trans('date'); ?></td>
                                <td><?php echo date("Y-m-d / h:i", strtotime($deposit->created_at)); ?></td>                                    
                            </tr>
                            <tr>
                                <td><?php echo trans('user'); ?></td>
                                <td>
                                <?php if ($deposit->user_id == 0): ?>
                                    <label class="label bg-olive"><?php echo trans("guest"); ?></label>
                                <?php else:
                                    $user = get_user($deposit->user_id);
                                    if (!empty($user)):?>
                                        <div class="table-orders-user">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $user->slug; ?>" class="table-link" target="_blank">
                                                <?php echo html_escape($user->shipping_first_name); ?>
                                            </a>
                                        </div>
                                    <?php endif;
                                endif;
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo trans('receipt'); ?></td>
                                <td>
                                    <?php if (!empty($deposit->bukti)): ?>
                                        <a class="magnific-image-popup" href="<?= base_url('uploads/deposit/'.$deposit->bukti) ?>">
                                            <img src="<?= base_url('uploads/deposit/'.$deposit->bukti) ?>" alt="" style="max-width: 60px; max-height: 60px;">
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($latest_payout as $item):
    $payout = $this->earnings_model->get_user_payout_account($item->user_id);
    ?>
    <!-- Modal -->
    <div id="accountDetailsModel_<?php echo $item->id; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo trans($item->payout_method); ?></h4>
                </div>
                <div class="modal-body">
                    <?php if (!empty($payout)): ?>
                        <?php if ($item->payout_method == "paypal"): ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("user"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $user = get_user($payout->user_id);
                                    if (!empty($user)):?>
                                        <strong>
                                            &nbsp;<?php echo $user->username; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("paypal_email_address"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->payout_paypal_email; ?>
                                    </strong>
                                </div>
                            </div>
                        <?php elseif ($item->payout_method == "iban"): ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("user"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $user = get_user($payout->user_id);
                                    if (!empty($user)):?>
                                        <strong>
                                            &nbsp;<?php echo $user->username; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("full_name"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->iban_full_name; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="col-sm-4">
                                    <?php echo trans("country"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $country = get_country($payout->iban_country_id);
                                    if (!empty($country)):?>
                                        <strong>
                                            &nbsp;<?php echo $country->name; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_name"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->iban_bank_name; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_number"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->iban_number; ?>
                                    </strong>
                                </div>
                            </div>
                        <?php elseif ($item->payout_method == "swift"): ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("user"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $user = get_user($payout->user_id);
                                    if (!empty($user)):?>
                                        <strong>
                                            &nbsp;<?php echo $user->username; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("full_name"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_full_name; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("address"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_address; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("state"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_state; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("city"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_city; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("postcode"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_postcode; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("country"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $branch_country = get_country($payout->swift_country_id);
                                    if (!empty($branch_country)):?>
                                        <strong>
                                            &nbsp;<?php echo $branch_country->name; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_account_holder_name"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_bank_account_holder_name; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("iban"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_iban; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("swift_code"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_code; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_name"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_bank_name; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_branch_city"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <strong>
                                        &nbsp;<?php echo $payout->swift_bank_branch_city; ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php echo trans("bank_branch_country"); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $branch_country = get_country($payout->swift_bank_branch_country_id);
                                    if (!empty($branch_country)):?>
                                        <strong>
                                            &nbsp;<?php echo $branch_country->name; ?>
                                        </strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php endforeach; ?>

<style>
    .modal-body .row {
        margin-bottom: 8px;
    }
</style>

<script src="<?= base_url(); ?>assets/vendor/Chart.js/dist/Chart.min.js"></script>
<script>
const select = dom => document.querySelector(dom)

let report = [
    {
        label: "Produk Tertunda",
        data: [],
        borderColor: '#e74c3c',
        fill: false,
    },
    {
        label: "Payout",
        data: [],
        borderColor: '#2ecc71',
        fill: false,
    },
    {
        label: "Transaksi",
        data: [],
        borderColor: '#3498db',
        fill: false,
    },
    {
        label: "Permintaan Pembukaan Toko",
        data: [],
        borderColor: '#fcd840',
        fill: false,
    },
]
const request = (url, data) => {
    return fetch(url, {
        method: 'GET',
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => res.json())
}
const scrollKe = dom => {
    select(dom).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    })
}
const createEl = props => {
    let el = document.createElement(props.el)
    if (props.attribute !== undefined) {
        props.attribute.forEach(res => {
            el.setAttribute(res[0], res[1])
        })
    }
    if (props.html !== undefined) {
        // let val = document.createElement('span')
        el.innerHTML = props.html
        // el.appendChild(val)
    }
    document.querySelector(props.createTo).appendChild(el)
}
let reportChart
const generateChart = () => {
    let ctx = select("#report").getContext('2d')
    reportChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: "<?= $dates; ?>".split(","),
            datasets: report
        },
        options: {
            animation: {
                duration: 0
            }
        }
    })
}
generateChart()
const fetchSummary = () => {
    reportChart.data.datasets[0]['data'] = []
    let path = "<?= base_url(); ?>Admin_controller/get_dashboard_summary"
    let req = request(path)
    .then(res => {
        report[0].data = []
        report[1].data = []
        report[2].data = []
        report[3].data = []

        let pendingProduct = res.pending_product
        for (var key in pendingProduct) {
            report[0].data.push(pendingProduct[key].length)
        }

        let payouts = res.payouts
        for (var key in payouts) {
            report[1].data.push(payouts[key].length)
        }

        let transactions = res.transactions
        for (var key in transactions) {
            report[2].data.push(transactions[key].length)
        }

        let shops = res.shops
        for (var key in shops) {
            report[3].data.push(shops[key].length)
        }
        reportChart.update()
    })
}
setInterval(() => {
    fetchSummary()
}, 1000);

const formatDate = fullDate => {
    let date = fullDate.split(" ")[0]
    let time = fullDate.split(" ")[1]
    let t = time.split(":")
    let timeShown = t[0]+":"+t[1]
    return date + " / " + timeShown
}
const getDashboardData = () => {
    let path = "<?= base_url(); ?>Admin_controller/get_dashboard_data"
    let req = request(path)
    .then(res => {
        select("#latestOrders").innerHTML = ""
        select("#latestPendingProducts").innerHTML = ""
        select("#latestProducts").innerHTML = ""
        
        let latestOrders = res.latest_orders
        latestOrders.forEach(order => {
            let status = order.status == 1 ? "Sudah selesai" : "Sedang diproses"
            let date = new Date(order.created_at)

            createEl({
                el: 'tr',
                html: `<td style="width: 100px !important;">#${order.order_number}</td>
<td>${order.price_total}</td>
<td>${status}</td>
<td>${formatDate(order.created_at)}</td>
<td style="width: 10%">
    <a href="<?php echo admin_url(); ?>order-details/<?php echo html_escape('`+order.id+`'); ?>" class="btn btn-xs btn-info"><?php echo trans('details'); ?></a>
</td>`,
                createTo: '#latestOrders'
            })
        })

        let latestPendingProducts = res.latest_pending_products
        latestPendingProducts.forEach(item => {
            createEl({
                el: 'tr',
                html: `<td style="width: 10%">${item.id}</td>
<td class="index-td-product">
    <img src="<?php echo get_product_image('`+item.id+`', 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
    ${item.title}
</td>
<td style="width: 10%;vertical-align: center !important;">
    <a href="<?php echo admin_url(); ?>product-details/<?php echo html_escape('`+item.id+`'); ?>" class="btn btn-xs btn-info"><?php echo trans('details'); ?></a>
</td>`,
                createTo: '#latestPendingProducts'
            })
        })

        let latestProducts = res.latest_products
        latestProducts.forEach(item => {
            createEl({
                el: 'tr',
                html: `<td style="width: 10%"><?php echo html_escape('`+item.id+`'); ?></td>
<td class="index-td-product">
    <img src="<?php echo get_product_image(`+item.id+`, 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
    <?php echo html_escape('`+item.title+`'); ?>
</td>
<td style="width: 10%">
    <a href="<?php echo admin_url(); ?>product-details/<?php echo html_escape($item->id); ?>" class="btn btn-xs btn-info"><?php echo trans('details'); ?></a>
</td>`,
                createTo: '#latestProducts'
            })
        })
    })
}
getDashboardData()
</script>

