<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$active_status = empty($active_status) ? '' : $active_status;

if (isset($_GET['q'])) {
    $active_status = 'search';
}
?>

<div class="box">
    <div class="box-header with-border">
        <div class="flex-row" style="align-items: flex-end">
            <div class="col">
                <h1 class="m-0"><?php echo $title; ?></h1>
            </div>
            <div class="col-auto">
                <div class="box-note box-note-info">
                    <div class="flex-row">
                        <div class="col">
                            <small><?php echo strtoupper(trans('sale')); ?></small>
                        </div>
                        <div class="col">
                            <small style="white-space: nowrap"><?php echo trans('number_of_total_sales'); ?></small>
                        </div>
                    </div>
                    <h2 style="text-align:right; margin: 0"><?php echo $order_count; ?></h2>
                </div>
                <div class="box-note box-note-warning">
                    <div class="flex-row">
                        <div class="col">
                            <small><?php echo strtoupper(trans('balance')); ?></small>
                        </div>
                        <div class="col">
                            <small style="white-space: nowrap"><?php echo trans('balance_exp'); ?></small>
                        </div>
                    </div>
                    <h2 style="text-align:right; margin: 0">$5,182</h2>
                </div>
            </div>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="row">
            <!-- include message block -->
            <div class="col-sm-12">
                <?php $this->load->view('admin/includes/_messages'); ?>
            </div>
        </div>
        <ul class="nav nav-tabs order-nav-tabs mb-3" role="tablist" id="nav-order-tabs">
            <?php /*
            <li class="nav-item">
                <a
                    class="nav-link<?php echo '' === $active_status ? ' active' : '' ?>"
                    href="<?php echo admin_url() . 'orders'; ?>"
                    data-target="#order-content-0"
                    >
                    <span><?php echo trans("all"); ?></span>
                </a>
            </li>
            */ ?>
            <?php if ('search' === $active_status): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-target="#order-content-0">
                        <span><?php echo trans("search"); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo empty($active_status) || 'earnings' === $active_status ? ' active' : '' ?>"
                    href="<?php echo admin_url() . 'earnings'; ?>" data-target="#order-content-0">
                    <span><?php echo trans("earnings"); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo 'payouts' === $active_status ? ' active' : '' ?>"
                    href="<?php echo admin_url() . 'completed-payouts'; ?>" data-target="#order-content-0">
                    <span><?php echo trans("payouts"); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo 'add-payout' === $active_status ? ' active' : '' ?>"
                    href="<?php echo admin_url() . 'add-payout'; ?>" data-target="#order-content-0">
                    <span><?php echo trans("add_payout"); ?></span>
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?php $this->load->view('admin/earnings/_filter_earnings'); ?>
                    <table class="table table-bordered table-striped modern-table" role="grid">
                        <thead>
                        <tr role="row">
                            <th><?php echo trans('order'); ?></th>
                            <th><?php echo trans('user'); ?></th>
                            <th><?php echo trans('price'); ?></th>
                            <th><?php echo trans('commission_rate'); ?></th>
                            <th><?php echo trans('shipping_cost'); ?></th>
                            <th><?php echo trans('earned_amount'); ?></th>
                            <th><?php echo trans('date'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($earnings as $item): ?>
                            <tr>
                                <td>#<?php echo $item->order_number; ?></td>
                                <td>
                                    <?php
                                    $user = get_user($item->user_id);
                                    if (!empty($user)):
                                        ?>
                                        <div class="table-orders-user table-orders-user-wide">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $user->slug; ?>" target="_blank">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="buyer" class="img-responsive" style="height: 40px;">
                                                <span><?php echo html_escape($user->username); ?></span>
                                            </a>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </td>
                                <td><?php echo print_price($item->price, $item->currency); ?></td>
                                <td><?php echo $item->commission_rate; ?>%</td>
                                <td><?php echo print_price($item->shipping_cost, $item->currency); ?></td>
                                <td><?php echo print_price($item->earned_amount, $item->currency); ?></td>
                                <td><?php echo $item->created_at; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle" type="button"
                                            data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('earnings_admin_controller/delete_earning_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <?php if (empty($earnings)): ?>
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
    </div><!-- /.box-body -->
</div>
