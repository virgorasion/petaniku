<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="widget-seller">
    <h4 class="sidebar-title">Pilihan Paket</h4>

    <?php if (!empty($half_width_product_variations)):
        foreach ($half_width_product_variations as $paket): ?>
        
        <?php if($paket->visible): ?>
    	<?php echo form_open(lang_base_url() . 'add-to-cart', ['id' => 'form_add_cart_paket' . $input_form_suffix]); ?>        
        <div>
            <div>
                <h4><?= $paket->label ?></h4><br>
                <?php if($paket->gambar != NULL): ?>
                    <img src="<?= get_paket_gambar($paket) ?>" />
                    <br><br>
                <?php endif; ?>
                <p>
                    <?= $paket->deskripsi ?>
                </p>            
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <strong>Telah Diklaim</strong> <?= $paket->diklaim ?>

                        <?php if($paket->unlimited): ?>
                        dari paket tak terbatas
                        <?php else: ?>
                        dari <?= $paket->total_semua - $paket->diklaim ?> paket
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($this->auth_user->id != $product->user_id): ?>
            <div class="row-custom m-t-15">
                <input type="hidden" name="variation<?php echo $paket->id; ?>[]" value="<?= $paket->label ?>">
                <input type="hidden" name="paket_id<?php echo $paket->id; ?>[]" value="<?= $paket->id ?>">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <input type="hidden" onchange="checkQty(this, '<?= $paket->minimal ?>', '<?= $paket->unlimited ?>')" name="product_quantity" class="form-control" min="<?= $paket->minimal ?>" value="<?= $paket->minimal ?>">

                <button class="btn btn-md btn-favorite">Pilih Paket</button>
            </div>
            <br> <br>
            <br> <br>
            <?php endif; ?>
            <hr>
        </div>
    	<?php echo form_close(); ?>        
        <?php endif; ?>

    <?php
        endforeach;
    endif; ?>
</div>

<script>
    function checkQty(that, minimal, unlimited) {
        var value = parseInt($(that).val());
        if(unlimited == false) {
            if (value < minimal) {
                $(that).val(minimal);
            }
        }
    }
</script>