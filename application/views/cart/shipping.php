<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart shopping-cart-shipping">
                    <div class="row">
                        <div class="col-sm-12 col-lg-7">
                            <div class="left">

        
                                <?php if ($this->session->flashdata('product_details_error')): 
                                    $errorse = $this->session->flashdata('product_details_error');
                                    $prod_errors = explode('<br>', $errorse);
                                    foreach($prod_errors as $error_pesan):
                                ?>
                                    <?php if($error_pesan == ""): ?>
                                    <div class="row-custom m-t-15">
                                        <br>
                                    </div>                                    
                                    <?php else: ?>
                                    <div class="row-custom m-t-15">
                                        <div class="product-details-message error-message">
                                            <p>
                                                <i class="icon-times"></i>
                                                <?= $error_pesan ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; endif; ?>

                                <h1 class="cart-section-title"><?php echo trans("checkout"); ?></h1>

                                <?php if (!auth_check()): ?>
                                    <div class="row m-b-15">
                                        <div class="col-12 col-md-6">
                                            <p><?php echo trans("checking_out_as_guest"); ?></p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="text-right"><?php echo trans("have_account"); ?>&nbsp;<a href="javascript:void(0)" class="link-underlined" data-toggle="modal" data-target="#loginModal"><?php echo trans("login"); ?></a></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="tab-checkout tab-checkout-open m-t-0">
                                    <h2 class="title">1.&nbsp;&nbsp;<?php echo trans("shipping_information"); ?></h2>
                                    <?php echo form_open("cart_controller/shipping_post", ['id' => 'form_validate']); ?>
                                    <div class="row">
                                        <div class="col-12 cart-form-shipping-address">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15 hidden">
                                                        <label><?php echo trans("country"); ?>*</label>
                                                        <div class="selectdiv">
                                                            <select id="countries" name="shipping_country_id" class="form-control" required>
                                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                                <?php foreach ($countries as $item): ?>
                                                                    <option value="<?php echo $item->id; ?>" <?php echo ($item->id == 102) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("state"); ?>*</label>
                                                        <select id="states" name="shipping_state" class="form-control" onchange="get_cities_ship(this.value);">
                                                            <option value=""><?php echo trans('state'); ?></option>
                                                            <?php ?>
                                                            <?php
                                                            if (!empty($states)):
                                                                foreach ($states as $provinsi): 
                                                                    if(!in_array($provinsi->id, $kirim_ke_provinsi)) continue;
                                                                ?>
                                                                    <option value="<?php echo $provinsi->id; ?>" <?= ($provinsi->id == $shipping_address->shipping_state) ? 'selected' : '' ?>><?php echo html_escape($provinsi->name); ?></option>
                                                                <?php endforeach;
                                                            endif; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("city"); ?>*</label>
                                                        <div class="selectdiv">
                                                            <select id="cities" name="shipping_city" class="form-control" onchange="get_kecamatan_ship(this.value);">
                                                                <option value=""><?php echo trans('city'); ?></option>
                                                                <?php
                                                                if (!empty($cities)):
                                                                    foreach ($cities as $item): ?>
                                                                        <option value="<?php echo $item->id; ?>" <?= ($item->id == $shipping_address->shipping_city) ? 'selected' : '' ?>><?php echo html_escape($item->name); ?></option>
                                                                    <?php endforeach;
                                                                endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <br>
                                                        <label>Kecamatan</label>
                                                        <select id="kecamatan" name="shipping_kecamatan" class="form-control kecamatan_ongkir_edit" onchange="update_product_map();">
                                                            <option value="">Kecamatan</option>
                                                            <?php
                                                            if (!empty($kecamatan)):
                                                                foreach ($kecamatan as $item): ?>
                                                                    <option value="<?php echo $item->id; ?>" <?= ($item->id == $shipping_address->shipping_kecamatan) ? 'selected' : '' ?>><?php echo html_escape($item->name); ?></option>
                                                                <?php endforeach;
                                                            endif; ?>
                                                        </select>
                                                        <!-- <input type="text" name="shipping_kecamatan" class="form-control form-input" value="<?php echo $shipping_address->shipping_kecamatan; ?>" placeholder="Kecamatan" required> -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <br>                                                    
                                                        <label><?php echo trans("zip_code"); ?>*</label>
                                                        <input type="text" name="shipping_zip_code" class="form-control form-input" value="<?php echo $shipping_address->shipping_zip_code; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 1*</label>
                                                <textarea name="shipping_address_1" class="form-control form-input" placeholder="<?php echo trans("address"); ?>" required><?php echo $shipping_address->shipping_address_1; ?></textarea>                                                
                                                <!-- <input type="text" name="shipping_address_1" class="form-control form-input" value="<?php echo $shipping_address->shipping_address_1; ?>" required> -->
                                            </div>
                                            <div class="form-group hidden">
                                                <label><?php echo trans("address"); ?> 2 (<?php echo trans("optional"); ?>)</label>
                                                <input type="text" name="shipping_address_2" class="form-control form-input" value="<?php echo $shipping_address->shipping_address_2; ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-12 m-b-sm-15">
                                                        <label>Nama Lengkap *</label>
                                                        <input type="text" name="shipping_first_name" class="form-control form-input" value="<?php echo $shipping_address->shipping_first_name; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 hidden">
                                                        <label><?php echo trans("last_name"); ?>*</label>
                                                        <input type="text" name="shipping_last_name" class="form-control form-input" value="<?php echo $shipping_address->shipping_last_name; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15 hidden">
                                                        <label><?php echo trans("email"); ?>*</label>
                                                        <input type="email" name="shipping_email" class="form-control form-input" value="<?php echo $shipping_address->shipping_email; ?>">
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <label><?php echo trans("phone_number"); ?>*</label>
                                                        <input type="text" name="shipping_phone_number" class="form-control form-input" value="<?php echo $shipping_address->shipping_phone_number; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 cart-form-billing-address hidden" >
                                            <h3 class="title-billing-address"><?php echo trans("billing_address") ?></h3>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("first_name"); ?>*</label>
                                                        <input type="text" name="billing_first_name" class="form-control form-input" value="<?php echo $shipping_address->billing_first_name; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("last_name"); ?>*</label>
                                                        <input type="text" name="billing_last_name" class="form-control form-input" value="<?php echo $shipping_address->billing_last_name; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("email"); ?>*</label>
                                                        <input type="email" name="billing_email" class="form-control form-input" value="<?php echo $shipping_address->billing_email; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("phone_number"); ?>*</label>
                                                        <input type="text" name="billing_phone_number" class="form-control form-input" value="<?php echo $shipping_address->billing_phone_number; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 1*</label>
                                                <input type="text" name="billing_address_1" class="form-control form-input" value="<?php echo $shipping_address->billing_address_1; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 2 (<?php echo trans("optional"); ?>)</label>
                                                <input type="text" name="billing_address_2" class="form-control form-input" value="<?php echo $shipping_address->billing_address_2; ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("country"); ?>*</label>
                                                        <div class="selectdiv">
                                                            <select id="countries" name="billing_country_id" class="form-control" required>
                                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                                <?php foreach ($countries as $item): ?>
                                                                    <option value="<?php echo $item->id; ?>" <?php echo ($shipping_address->billing_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("state"); ?>*</label>
                                                        <input type="text" name="billing_state" class="form-control form-input" value="<?php echo $shipping_address->billing_state; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("city"); ?>*</label>
                                                        <input type="text" name="billing_city" class="form-control form-input" value="<?php echo $shipping_address->billing_city; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("zip_code"); ?>*</label>
                                                        <input type="text" name="billing_zip_code" class="form-control form-input" value="<?php echo $shipping_address->billing_zip_code; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 hidden">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input checked type="checkbox" class="custom-control-input" name="use_same_address_for_billing" value="1" id="use_same_address_for_billing" <?php echo ($shipping_address->use_same_address_for_billing == 1) ? 'checked' : ''; ?>>
                                                    <label for="use_same_address_for_billing" class="custom-control-label"><?php echo trans("use_same_address_for_billing"); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-t-15">
                                        <a href="<?php echo lang_base_url(); ?>cart" class="link-underlined link-return-cart"><&nbsp;<?php echo trans("return_to_cart"); ?></a>
                                        <button type="submit" name="submit" value="update" class="btn btn-lg btn-custom float-right"><?php echo trans("continue_to_payment_method") ?></button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>

                                <div class="tab-checkout tab-checkout-closed-bordered">
                                    <h2 class="title">2.&nbsp;&nbsp;<?php echo trans("payment_method"); ?></h2>
                                </div>

                                <div class="tab-checkout tab-checkout-closed-bordered border-top-0">
                                    <h2 class="title">3.&nbsp;&nbsp;<?php echo trans("payment"); ?></h2>
                                </div>
                            </div>
                        </div>

						<?php if ($mds_payment_type == 'promote') {
							$this->load->view("cart/_order_summary_promote");
						} else {
							$this->load->view("cart/_order_summary");
						} ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<script>
$(document).ready(function(){
    $('#states').change(function(){
        $('#cities').val("");
        $('#kecamatan').val("");
        get_ongkirs_berapa();
    });
    $('#cities').change(function(){
        $('#kecamatan').val("");
        get_ongkirs_berapa();
    });
    $('#kecamatan').change(function(){
        get_ongkirs_berapa();
    });

    function convertToRupiah(angka)
    {
        var rupiah = '';		
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp'+rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function convertToAngka(rupiah)
    {
        return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
    }

    function get_ongkirs_berapa() {
        var data = {
            "provinsi": $('#states').val(),
            "kota": $('#cities').val(),
            "kecamatan": $('#kecamatan').val(),
            "lang_folder": lang_folder
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "cart_controller/cek_ongkir",
            data: data,
            success: function (response) {
                var ongkir = response;
                $('.ongkir_pd').html(convertToRupiah(ongkir));
                $('.ongkirtotal_pd').html(convertToRupiah(ongkir));

                var total = 0
                var subtotal = $('.subtotal_pd').text();
                subtotal = convertToAngka(subtotal)

                total = parseInt(subtotal) + parseInt(ongkir)
                $('.total_pd').html(convertToRupiah(total));
            }
        });
    }
});

function get_cities_ship(val){
    var data = {
        "filter": "kota",
        "state_id": val,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/get_ongkir",
        data: data,
        success: function (response) {
            $('#cities').children('option:not(:first)').remove();
            $("#cities").append(response);
        }
    });
}

function get_kecamatan_ship(val){
    var data = {
        "filter": "kecamatan",
        "city_id": val,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/get_ongkir",
        data: data,
        success: function (response) {
            $('#kecamatan').children('option:not(:first)').remove();
            $("#kecamatan").append(response);
        }
    });
}
</script>
