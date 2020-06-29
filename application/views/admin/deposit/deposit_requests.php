<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header with-border">
		<div class="left">
			<h3 class="box-title">Deposit Request</h3>
		</div>
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
                        <?php $this->load->view('admin/earnings/_filter_payouts'); ?>
                        <thead>
                        <tr role="row">
                            <!-- <th><?php echo trans('id'); ?></th> -->
                            <th><?php echo trans('date'); ?></th>
                            <!-- <th><?php echo trans('user_id'); ?></th> -->
                            <th><?php echo trans('user'); ?></th>
                            <th>Detail Bank</th>
                            <th>Jumlah Deposit</th>
                            <th>Jumlah Transfer (Deposit + Kode unik)</th>
                            <th><?php echo trans('status'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($payout_requests as $item): ?>
                            <tr>
                                <td><?php echo $item->created_at; ?></td>
                                <!-- <td><?php echo $item->id; ?></td> -->
                                <!-- <td><?php echo $item->user_id; ?></td> -->
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
                                    <p>
                                        Bank : <?= $item->bank_type ?> <br>
                                        Nama Bank : <?= $item->bank_name ?> <br>
                                        Nomor Bank : <?= $item->bank_number ?> <br>
                                    </p>
                                    <p class="m-0">
                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#accountDetailsModel_<?php echo $item->id; ?>"><?php echo trans("see_details"); ?></button>
                                    </p>
                                </td>
                                <td><?php echo print_price($item->amount, $item->currency); ?></td>
                                <td><?php echo print_price($item->transfer, $item->currency); ?></td>
                                <td>
                                    <?php if ($item->status == 1) { ?>
                                        <label class="label label-success"><?php echo trans("completed"); ?></label>
                                    <?php } else { ?>
                                        <label class="label label-warning"><?php echo trans("pending"); ?></label>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo form_open_multipart('balance_admin_controller/complete_deposit_request_post'); ?>
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
                                            <?php if ($item->status == 0): ?>
                                            <li>
                                                <button type="submit" name="option" value="completed" class="btn-list-button">
                                                    <i class="fa fa-check option-icon"></i><?php echo trans('completed'); ?>
                                                </button>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('balance_admin_controller/delete_deposit_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php echo form_close(); ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <?php if (empty($payout_requests)): ?>
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

<?php foreach ($payout_requests as $item):
    $payout = $this->earnings_model->get_user_payout_account($item->user_id);
    ?>
    <!-- Modal -->
    <div id="accountDetailsModel_<?php echo $item->id; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bukti Transfer</h4>
                </div>
                <div class="modal-body">
                    <img title="Bukti Transfer" class="img-responsive" title="Bukti Transfer" src="<?= base_url('uploads/deposit/'.$item->bukti) ?>">
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
