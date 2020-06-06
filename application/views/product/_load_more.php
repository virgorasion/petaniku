<?php foreach ($latest_products as $product): ?>
    <div class="col-6 col-sm-6 col-md-4 col-lg-25 col-product">
        <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => false]); ?>
    </div>
<?php endforeach; ?>