<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="widget-seller">
    <h4 class="sidebar-title">Cek Ongkir</h4>

    <div class="widget-content">
        <div class="card card-body" style="margin: 0 !important;background: #eaeaea1a;">
            <div class="row">
                <div class="col-12 col-md-12 m-b-sm-15">
                    <label><?php echo trans("state"); ?></label>
                    <select id="states" name="shipping_state" class="form-control" onchange="get_cities_ship(this.value);">
                        <option value=""><?php echo trans('state'); ?></option>
                        <?php ?>
                        <?php
                        if (!empty($states)):
                            foreach ($states as $provinsi): 
                                if(!in_array($provinsi->id, $kirim_ke_provinsi)) continue;
                            ?>
                                <option value="<?php echo $provinsi->id; ?>"><?php echo html_escape($provinsi->name); ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                </div>

                <div class="col-12 col-md-12 m-b-sm-15">
                    <br>
                    <label><?php echo trans("city"); ?></label>
                    <div class="selectdiv">
                        <select id="cities" name="shipping_city" class="form-control" onchange="get_kecamatan_ship(this.value);">
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

                <div class="col-12 col-md-12 m-b-sm-15">
                    <br>
                    <label>Kecamatan</label>
                    <select id="kecamatan" name="shipping_kecamatan" class="form-control kecamatan_ongkir_edit" onchange="update_product_map();">
                        <option value="">Kecamatan</option>
                        <?php
                        if (!empty($kecamatan)):
                            foreach ($kecamatan as $item): ?>
                                <option value="<?php echo $item->id; ?>" ><?php echo html_escape($item->name); ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                    <!-- <input type="text" name="shipping_kecamatan" class="form-control form-input" value="<?php echo $shipping_address->shipping_kecamatan; ?>" placeholder="Kecamatan" required> -->
                </div>

                <div class="col-md-12">
                    <br><br>
                    <h6>
                        <?php echo trans("shipping"); ?><strong class="float-right ongkirtotal_pd"><?php echo print_price(0, $this->payment_settings->default_product_currency); ?></strong>                            
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>


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
            url: base_url + "cart_controller/cek_ongkir/<?= $product->id ?>",
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
        url: base_url + "product_controller/get_ongkir/<?= $product->id ?>",
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
        url: base_url + "product_controller/get_ongkir/<?= $product->id ?>",
        data: data,
        success: function (response) {
            $('#kecamatan').children('option:not(:first)').remove();
            $("#kecamatan").append(response);
        }
    });
}
</script>