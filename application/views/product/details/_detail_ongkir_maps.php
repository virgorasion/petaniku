<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="widget-seller">
    <h4 class="sidebar-title">Cek Ongkir</h4>

    <div class="widget-content">
        <?php if($product->pengiriman){ ?>
            <?php $this->load->view('mapongkir-google', ['start' => $product->pengiriman]); ?>
            <div class="card card-body" style="background: #eaeaea1a;">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h6>
                            Batas pengiriman
                            <strong class="float-right"><?= ($product->km_max) ? $product->km_max : 0 ?> km</strong>                            
                        </h6>
                    </div>
                    <div class="col-12 col-md-12">
                        <h6>
                            Total Jarak
                            <strong class="float-right totaljarak">0 km</strong>                            
                        </h6>
                    </div>
                    <div class="col-12 col-md-12">
                        <h6>
                            Harga / km
                            <strong class="float-right"><?= print_price($product->km_price, $this->payment_settings->default_product_currency) ?></strong>
                        </h6>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <h6>
                            <?php echo trans("shipping"); ?><strong class="float-right ongkirtotal_pd"><?php echo print_price(0, $this->payment_settings->default_product_currency); ?></strong>                            
                        </h6>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="alert alert-danger">
                Penjual belum mengkonfigurasi titik pengiriman
            </div>
        <?php } ?>

        
    </div>
</div>


<script>
    var km_max = <?= ($product->km_max) ? $product->km_max : 0 ?>;
    var km_price = <?= ($product->km_price) ? price_format_input($product->km_price) : 0 ?>;

    function getClicked(distance) {
        $('.totaljarak').text(distance + " km");

        if(distance > km_max) {
            $('.totaljarak').addClass('text-danger');
        } else {
            $('.totaljarak').removeClass('text-danger');            
        }

        var ongkir = distance * km_price;
        $('.ongkirtotal_pd').text(convertToRupiah(ongkir));
    }

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
</script>