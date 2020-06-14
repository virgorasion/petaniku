<?php

$this->load->view('mapinit', ['start' => $product->pengiriman]);

?>

<div class="card">
    <div class="card-body" style="background:#939494;color:#FFF">
        Pilih lokasi pengiriman dari maps. Untuk mencari lokasi dengan pencarian, Anda dapat mengklik zoom out / simbol minus terlebih dahulu.
    </div>
</div>

<div class="form-group">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label>Latitude Longitude</label>
                <input id="input_pengiriman" placeholder="Latitude Longitude" class="form-control" type="text" name="pengiriman" value="<?= $product->pengiriman ?>" required>
            </div>
            <div class="col-md-4">
                <label>Jarak Maksimal Pengiriman</label>
                <input placeholder="Jarak Maksimal (km)" class="form-control" type="number" min="1" name="km_max" value="<?= $product->km_max ?>" required>    
            </div>
            <div class="col-md-4">
                <label>Harga pengiriman tiap (km)</label>
                <input placeholder="Harga pengiriman tiap (km)" class="form-control" type="number" min="1" name="km_price" value="<?= ($product->km_price) ? price_format_input($product->km_price) : 0 ?>" required>    
            </div>
        </div>
    </div>
</div>

<script>
    function getClicked(latlng) {
        $('#input_pengiriman').val(latlng);
    }
</script>