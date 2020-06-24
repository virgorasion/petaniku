<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="modal fade" id="addVariationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <form id="form_add_product_variation" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Paket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 tab-variation">
                                <div class="form-group m-b-10 hidden">
                                    <label class="control-label"><?php echo trans('label'); ?></label>
                                    <?php if (!empty($languages)): ?>
                                        <?php if (count($languages) <= 1): ?>
                                            <input type="text" class="form-control form-input input-variation-label" name="label_lang_<?php echo $this->selected_lang->id; ?>" maxlength="255">
                                        <?php else: ?>
                                            <?php foreach ($languages as $language): ?>
                                                <?php if ($language->id == $this->selected_lang->id): ?>
                                                    <input type="text" class="form-control form-input input-variation-label" name="label_lang_<?php echo $language->id; ?>" placeholder="<?php echo $language->name; ?>" maxlength="255">
                                                <?php else: ?>
                                                    <input type="text" class="form-control form-input input-variation-label" name="label_lang_<?php echo $language->id; ?>" placeholder="<?php echo $language->name . ' (' . trans("optional") . ')'; ?>" maxlength="255">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group hidden">
                                    <label class="control-label"><?php echo trans('variation_type'); ?></label>
                                    <div class="selectdiv">
                                        <select name="variation_type" class="form-control" onchange="show_variation_options_box(this.value);">
                                            <option value="text" checked><?php echo trans('text'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Pembelian</label>
                                    <div>
                                        <input type="number" class="form-control form-input input-variation-label" name="minimal" placeholder="Pembelian" maxlength="255">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <input type="checkbox" name="is_limited" value="1" id="total_paket_checkbox">
                                        Total Paket yang tersedia
                                    </label>
                                    <div>
                                        <input id="total_paket_inp" type="number" class="form-control form-input input-variation-label hidden" name="total_semua" placeholder="Paket yang tersedia" maxlength="255">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <div>
                                        <textarea class="form-control" name="deskripsi" name="deskripsi" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Gambar (Opsional)</label>
                                    <div>
                                        <div class="form-group">
                                            <p>
                                                <img src="<?php echo get_paket_gambar(null); ?>" alt="Gambar" class="form-avatar">
                                            </p>
                                            <p>
                                                <a class='btn btn-md btn-secondary btn-file-upload'>
                                                    Pilih Gambar
                                                    <input id="filegambar" type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                                                </a>
                                                <span class='badge badge-info' id="upload-file-info"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <label class="control-label">Harga</label>                                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                            <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                        </div>
                                        <input style="height: 40px;margin:0" type="text" name="harga" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                    </div>
                                </div>
                                <div class="form-group m-0 hidden">
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-12">
                                            <label class="control-label"><?php echo trans('visible'); ?></label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 col-option">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="visible" value="1" id="edit_visible_1" class="custom-control-input" checked>
                                                <label for="edit_visible_1" class="custom-control-label"><?php echo trans('yes'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 col-option">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="visible" value="0" id="edit_visible_2" class="custom-control-input">
                                                <label for="edit_visible_2" class="custom-control-label"><?php echo trans('no'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-md btn-secondary btn-variation float-right"><?php echo trans("add_variation"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editVariationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <form id="form_edit_product_variation" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                    <div id="response_product_variation_edit"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editVariationOptionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <div id="response_product_variation_options_edit"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="variationModalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <form id="form_select_product_variation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo trans("created_variations"); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (empty($user_variations)): ?>
                            <p class="text-center m-t-20"><?php echo trans("msg_no_created_variations"); ?></p>
                        <?php else: ?>
                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <div class="form-group">
                                <label class="control-label"><?php echo trans('select_variation'); ?></label>
                                <div class="selectdiv">
                                    <select name="common_id" class="form-control" required>
                                        <?php $last_common_id = "";
                                        foreach ($user_variations as $user_variation):
                                            if ($user_variation->insert_type == "new"):
                                                if ($user_variation->common_id != $last_common_id):?>
                                                    <option value="<?php echo $user_variation->common_id; ?>"><?php echo html_escape($user_variation->label) . ' (' . trans($user_variation->variation_type) . ' )'; ?></option>
                                                <?php endif;
                                                $last_common_id = $user_variation->common_id; ?>
                                            <?php endif;
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <?php if (!empty($user_variations)): ?>
                            <button type="submit" class="btn btn-md btn-secondary btn-variation"><?php echo trans("select"); ?></button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view("product/paket/_js_paket"); ?>