<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.mfp-content {
    z-index: 99999999 !important;
}
.modal-backdrop{
    z-index: 1 !important;
}
</style>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="row">
            <!-- include message block -->
            <div class="col-sm-12">
                <?php $this->load->view('admin/includes/_messages'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?php $this->load->view('admin/order/_filter_transactions'); ?>
                        <thead>
                        <tr role="row">
                            <th><?php echo trans('date'); ?></th>
                            <!-- <th><?php //echo trans('id'); ?></th> -->
                            <th><?php echo trans('order'); ?></th>
                            <th><?php echo trans('payment_method'); ?></th>
                            <!-- <th><?php //echo trans('payment_id'); ?></th> -->
                            <th><?php echo trans('user'); ?></th>
                            <!-- <th><?php echo trans('currency'); ?></th> -->
                            <th>ID Bank</th>
                            <th><?php echo trans('payment_amount'); ?></th>
                            <th><?php echo trans('payment_status'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($transactions as $item): ?>
                            <tr>
                                <td><?php echo $item->created_at; ?></td>
                                <!-- <td><?php //echo $item->id; ?></td> -->
                                <td class="order-number-table">
                                    <?php
                                    $order = $this->order_admin_model->get_order($item->order_id);
                                    if (!empty($order)):
                                        ?>
                                        # <a href="<?php echo admin_url(); ?>order-details/<?php echo html_escape($item->order_id); ?>"><?= $order->order_number ?></a>
                                    <?php else: ?>
                                        Deposit
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($item->payment_method == "Bank Transfer") {
                                        echo trans("bank_transfer");
                                    } else {
                                        echo $item->payment_method;
                                    } ?>
                                </td>
                                <!-- <td><?php echo $item->payment_id; ?></td> -->
                                <td>
                                    <?php if ($item->user_id == 0): ?>
                                        <label class="label bg-olive"><?php echo trans("guest"); ?></label>
                                    <?php else:
                                        $user = get_user($item->user_id);
                                        if (!empty($user)):?>
                                            <div class="table-orders-user">
                                                <a href="<?php echo base_url(); ?>profile/<?php echo $user->slug; ?>" target="_blank">
                                                    <?php echo html_escape($user->username); ?>
                                                </a>
                                            </div>
                                        <?php endif;
                                    endif;
                                    ?>
                                </td>
                                <td class="hidden"><?php echo $item->currency; ?></td>
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
                                <?php else: ?>
                                    <td>
                                        -
                                    </td>                                
                                <?php endif; ?>
                                <td>                                        
                                    <?php 
                                        echo print_price($item->payment_amount, $item->currency); 
                                    ?>
                                </td>
                                <td><?php echo trans($item->payment_status); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('order_admin_controller/delete_transaction_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <?php if (empty($transactions)): ?>
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

<?php foreach ($transactions as $item):
    $order = $this->order_admin_model->get_order($item->order_id);
    if(!isset($order)) continue;
    $bank_tf = $this->order_admin_model->get_bank_transfer_by_order_number($order->order_number);
    ?>
    <!-- Modal -->
    <div id="accountDetailsModel_<?php echo $item->id; ?>" class="modal fade" 
        role="dialog" 
        style="z-index: 2 !important;">
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
                                    <td><?php echo trans('user'); ?></td>
                                    <td>
                                    <?php if ($bank_tf->user_id == 0): ?>
                                        <label class="label bg-olive"><?php echo trans("guest"); ?></label>
                                    <?php else:
                                        $user = get_user($bank_tf->user_id);
                                        if (!empty($user)):?>
                                            <div class="table-orders-user">
                                                <a href="<?php echo base_url(); ?>profile/<?php echo $user->slug; ?>" class="table-link" target="_blank">
                                                    <?php echo html_escape($user->username); ?>
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
                                <tr>
                                    <td><?php echo trans('status'); ?></td>
                                    <td>
                                        <?php if ($bank_tf->status == 'pending'): ?>
                                            <label class="label label-default"><?php echo trans("pending"); ?></label>
                                        <?php elseif ($bank_tf->status == 'approved'): ?>
                                            <label class="label label-success"><?php echo trans("approved"); ?></label>
                                        <?php elseif ($bank_tf->status == 'declined'): ?>
                                            <label class="label label-danger"><?php echo trans("declined"); ?></label>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo trans('ip_address'); ?></td>
                                    <td><?php echo $item->ip_address; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo trans('options'); ?></td>
                                    <td>
                                        <?php echo form_open_multipart('order_admin_controller/bank_transfer_options_post'); ?>
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
                                        <?php echo form_close(); ?>
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