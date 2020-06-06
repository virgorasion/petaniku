<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($pakets)): ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-product-variations">
                <thead>
                <tr>
                    <th scope="col"><?php echo trans("label"); ?></th>
                    <th scope="col">Paket yang tersedia</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col"><?php echo trans("visible"); ?></th>
                    <th scope="col" style="width: 250px;"><?php echo trans("options"); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $last_common_id = "";
                foreach ($pakets as $paket):
                    if ($last_common_id != $paket->common_id):?>
                        <tr>
                            <td><?php echo html_escape($paket->label); ?></td>
                            <td>
                                <?php echo $paket->total_semua ?>&nbsp;
                            </td>
                            <td>
                                <?php echo $paket->deskripsi ?>&nbsp;
                            </td>
                            <td>
                                <?php if ($paket->visible == 1):
                                    echo trans("yes");
                                else:
                                    echo trans("no");
                                endif; ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary btn-variation-table" onclick="edit_product_variation('<?php echo $paket->common_id; ?>','<?php echo $paket->product_id; ?>','<?php echo $paket->lang_id; ?>');">
                                    <span id="btn-variation-text-<?php echo $paket->common_id; ?>"><i class="icon-edit"></i><?php echo trans('edit'); ?></span>
                                    <div id="sp-<?php echo $paket->common_id; ?>" class="spinner spinner-btn-variation">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary btn-variation-table" onclick="delete_product_variation('<?php echo $paket->common_id; ?>','<?php echo $paket->product_id; ?>','<?php echo trans("confirm_variation"); ?>');"><i class="icon-trash"></i><?php echo trans('delete'); ?></a>
                            </td>
                        </tr>
                    <?php endif;
                    $last_common_id = $paket->common_id;
                endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
