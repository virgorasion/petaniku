<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('members'); ?></h3>
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
                    <table class="table table-bordered table-striped dataTable" id="cs_datatable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <!-- <th width="20"><?php //echo trans('id'); ?></th> -->
                            <th><?php echo trans('date'); ?></th>
                            <th><?php echo trans('image'); ?></th>
                            <th><?php echo trans('full_name'); ?></th>
                            <th><?php echo trans('balance'); ?></th>
                            <th><?php echo trans('description'); ?></th>
                            <th><?php echo trans('email'); ?></th>
                            <th><?php echo trans('status'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user->created_at; ?></td>
                                <!-- <td><?php //echo html_escape($user->id); ?></td> -->
                                <td>
                                    <img src="<?php echo get_user_avatar($user); ?>" alt="user" class="img-responsive" style="height: 50px;">
                                </td>
                                <td>
                                    <?php echo html_escape($user->username); ?>
                                    <?php if($user->getNewsletter): ?>
                                        <span class="label label-success"><i class="fa fa-check"></i></span>
                                    <?php endif ?>
                                    <br>
                                    <?php if(!empty($user->full_name)): ?>
                                        (<?= html_escape($user->full_name)?>)
                                    <?php endif ?>
                                </td>
                                <td><?= print_price($user->balance, 'IDR') ?></td>
                                <td><?php echo character_limiter($user->about_me); ?></td>
                                <td>
                                    <?php echo html_escape($user->email);
                                    if ($user->email_status == 1): ?>
                                        <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                                    <?php else: ?>
                                        <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                    <?php endif; ?>
                                    <br>
                                    <?php echo html_escape($user->phone_number);
                                    if ($user->phone_status == 1): ?>
                                        <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                                    <?php else: ?>
                                        Nomor Telp <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user->banned == 1): ?>
                                        <label class="label label-danger"><?php echo trans('banned'); ?></label>
                                    <?php elseif($user->role == "member"): ?>
                                        <label class="label label-warning">Belum Terverifikasi</label>
                                    <?php elseif($user->role == "vendor"): ?>
                                        <label class="label label-success">Terverifikasi</label>
                                    <?php endif; ?>
                                    <?php if($user->seller_status): ?>
                                        <label class="label label-success">Seller</label>
                                    <?php endif ?>                                        
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <!-- <li>
                                                <a href="javascript:void(0)" onclick="open_close_user_shop(<?php //echo $user->id; ?>,'');"><i class="fa fa-cart-plus option-icon"></i><?php //echo trans('open_user_shop'); ?></a>
                                            </li> -->
                                            <li>
                                                <?php if ($user->email_status != 1): ?>
                                                    <a href="javascript:void(0)" onclick="confirm_user_email(<?php echo $user->id; ?>);"><i class="fa fa-check option-icon"></i><?php echo trans('confirm_user_email'); ?></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <?php if ($user->banned == 0): ?>
                                                    <a href="javascript:void(0)" onclick="ban_remove_ban_user(<?php echo $user->id; ?>);"><i class="fa fa-stop-circle option-icon"></i><?php echo trans('ban_user'); ?></a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" onclick="ban_remove_ban_user(<?php echo $user->id; ?>);"><i class="fa fa-circle option-icon"></i><?php echo trans('remove_user_ban'); ?></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_user_post','<?php echo $user->id; ?>','<?php echo trans("confirm_user"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>