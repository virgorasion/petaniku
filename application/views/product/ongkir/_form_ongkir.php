<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="modal fade" id="addPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <form id="form_add_pengiriman" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengiriman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 tab-variation">
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('state'); ?></label>
                                    <div class="selectdiv">
                                        <select id="states" name="state_id" class="form-control" onchange="get_cities_ongkir(this.value);" <?php echo ($form_settings->product_location_required == 1) ? 'required' : ''; ?>>
                                            <option value=""><?php echo trans('state'); ?></option>
                                            <?php
                                            if (!empty($states)):
                                                foreach ($states as $item): ?>
                                                    <option value="<?php echo $item->id; ?>"><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('city'); ?></label>                                
                                    <div class="selectdiv">
                                        <select id="cities_ongkir" name="city_id" class="form-control" onchange="get_kecamatan_ongkir(this.value);">
                                            <option value=""><?php echo trans('city'); ?></option>
                                            <?php
                                            if (!empty($cities)):
                                                foreach ($cities as $item): ?>
                                                    <option value="<?php echo $item->id; ?>"><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Kecamatan</label>
                                    <!-- <div>
                                        <input type="text" name="address" id="address_input" class="form-control form-input" value="" placeholder="Kecamatan">                                    
                                    </div> -->
                                    <select id="kecamatan_ongkir" name="address" class="form-control" onchange="update_product_map();">
                                        <option value="">Kecamatan</option>
                                        <?php
                                        if (!empty($kecamatan)):
                                            foreach ($kecamatan as $item): ?>
                                                <option value="<?php echo $item->id; ?>"><?php echo html_escape($item->name); ?></option>
                                            <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ongkir</label>                                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                            <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                        </div>
                                        <input style="height: 40px;margin:0" type="text" name="ongkir" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" value="" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                    </div>
                                </div>
                                <div class="form-group m-0">
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
                        <button type="submit" class="btn btn-md btn-secondary btn-variation float-right">Tambah Ongkir</button>
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

        <div class="modal fade" id="editOngkirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
            <div class="modal-content">
                <form id="form_edit_product_ongkir" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                    <div id="response_product_ongkir_edit"></div>
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

<?php $this->load->view("product/ongkir/_js_ongkir"); ?>