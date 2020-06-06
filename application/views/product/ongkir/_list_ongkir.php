<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($ongkirs)): ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-product-variations">
                <thead>
                <tr>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Ongkir</th>
                    <th scope="col"><?php echo trans("visible"); ?></th>
                    <th scope="col" style="width: 250px;"><?php echo trans("options"); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $last_common_id = "";
                foreach ($ongkirs as $ongkir):
                    if ($last_common_id != $ongkir->common_id):?>
                        <tr>
                            <td>
                                <?php echo get_provinsi_id($ongkir->state_id) ?>&nbsp;
                            </td>
                            <td>
                                <?php echo get_kota_id($ongkir->city_id) ?>&nbsp;
                            </td>
                            <td>
                                <?php echo get_kecamatan($ongkir->address) ?>&nbsp;
                            </td>
                            <td>
                                <?php echo $ongkir->ongkir ?>&nbsp;
                            </td>
                            <td>
                                <?php if ($ongkir->visible == 1):
                                    echo trans("yes");
                                else:
                                    echo trans("no");
                                endif; ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary btn-variation-table" onclick="edit_product_ongkir('<?php echo $ongkir->common_id; ?>','<?php echo $ongkir->product_id; ?>','2');">
                                    <span id="btn-ongkir-text-<?php echo $ongkir->common_id; ?>"><i class="icon-edit"></i><?php echo trans('edit'); ?></span>
                                    <div id="sp-<?php echo $ongkir->common_id; ?>" class="spinner spinner-btn-variation">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary btn-variation-table" onclick="delete_product_ongkir('<?php echo $ongkir->common_id; ?>','<?php echo $ongkir->product_id; ?>','Apa Anda yakin akan menghapus pilihan pengiriman?');"><i class="icon-trash"></i><?php echo trans('delete'); ?></a>
                            </td>
                        </tr>
                    <?php endif;
                    $last_common_id = $ongkir->common_id;
                endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
