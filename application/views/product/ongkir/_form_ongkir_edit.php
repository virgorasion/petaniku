<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($ongkir)): ?>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="common_id" value="<?php echo $ongkir->common_id; ?>">
    <div class="modal-header">
        <h5 class="modal-title">Edit Paket</h5>
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
                        <select id="states" name="state_id" class="form-control" onchange="get_cities_ongkir_edit(this.value);">
                            <option value=""><?php echo trans('state'); ?></option>
                            <?php
                            if (!empty($states)):
                                foreach ($states as $item): ?>
                                    <option value="<?php echo $item->id; ?>" <?= ($item->id == $ongkir->state_id) ? 'selected' : '' ?>><?php echo html_escape($item->name); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans('city'); ?></label>                                
                    <div class="selectdiv">
                        <select name="city_id" class="form-control cities_ongkir_edit" onchange="get_kecamatan_ongkir(this.value)">
                            <option value=""><?php echo trans('city'); ?></option>
                            <?php
                            if (!empty($cities)):
                                foreach ($cities as $item): ?>
                                    <option value="<?php echo $item->id; ?>" <?= ($item->id == $ongkir->city_id) ? 'selected' : '' ?>><?php echo html_escape($item->name); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Kecamatan</label>
                    <!-- <div>
                        <input type="text" name="address" id="address_input" class="form-control form-input" value="<?= $ongkir->address ?>" placeholder="Kecamatan">                                    
                    </div> -->
                    <select name="address" class="form-control kecamatan_ongkir_edit" onchange="update_product_map();">
                        <option value="">Kecamatan</option>
                        <?php
                        if (!empty($kecamatan)):
                            foreach ($kecamatan as $item): ?>
                                <option value="<?php echo $item->id; ?>" <?= ($item->id == $ongkir->address) ? 'selected' : '' ?>><?php echo html_escape($item->name); ?></option>
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
                        <input style="height: 40px;margin:0" type="text" name="ongkir" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" value="<?= $ongkir->ongkir ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="form-group m-0">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <label class="control-label"><?php echo trans('visible'); ?></label>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="visible" value="1" id="edit_visible_1" class="custom-control-input" <?php echo ($ongkir->visible == 1) ? 'checked' : ''; ?>>
                                <label for="edit_visible_1" class="custom-control-label"><?php echo trans('yes'); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="visible" value="0" id="edit_visible_2" class="custom-control-input" <?php echo ($ongkir->visible != 1) ? 'checked' : ''; ?>>
                                <label for="edit_visible_2" class="custom-control-label"><?php echo trans('no'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row-custom">
            <button type="button" class="btn btn-md btn-danger color-white float-left hidden btn-show-variation-form"><i class="icon-arrow-left"></i><?php echo trans("back") ?></button>
            <button type="submit" class="btn btn-md btn-secondary btn-variation float-right"><?php echo trans("save_changes"); ?></button>
        </div>
    </div>
<?php endif; ?>