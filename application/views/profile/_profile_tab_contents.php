<?php
$active_classes = 'fade active show';
?>

<div class="tab-pane <?php echo ($active_tab == 'products') ? $active_classes : ''; ?>" id="tab-content-profile">
    <div class="profile-tab-content">
        <?php /*
        if (auth_check() && user()->id == $user->id):
            foreach ($products as $product):
                $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
            endforeach;
        else: ?>
        <div class="row row-product-items row-product">
            <!--print products-->
            <?php foreach ($products as $product): ?>
            <div class="col-6 col-sm-6 col-md-6 col-lg-25 col-product">
                <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif;
        */ ?>

        <div class="row row-product-items row-product">
            <?php
            $is_auth_check = auth_check();
            
            if($is_auth_check) {
                $is_user_owner = user()->id == $user->id;   
            } else {
                $is_user_owner = '';
            }
            
            foreach ($products as $product): ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-25 col-product">
                    <?php
                    // Warning: doing load/include/require inside a loop will cause performance issue
                    if ($is_auth_check && $is_user_owner):
                        $this->load->view('product/_product_item_editable', ['product' => $product, 'promoted_badge' => true]);
                    else:
                        // if($product->status == 0 && $product->is_draft == 1){
                            $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]);
                        // }
                    endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="product-list-pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<?php if (auth_check() && user()->id == $user->id): ?>
    <div class="tab-pane <?php echo ($active_tab == 'favorites') ? $active_classes : ''; ?>" id="tab-content-favorites">
        <div class="profile-tab-content">
            <div class="row row-product-items row-product">
                <!--print products-->
                <?php foreach ($favorite_products as $product): ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-25 col-product">
                    <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="tab-pane <?php echo ($active_tab == 'followers') ? $active_classes : ''; ?>" id="tab-content-followers">
        <div class="profile-tab-content">
            <div class="row py-3">
                <?php foreach ($followers as $item): ?>
                <div class="col-4 col-sm-2">
                    <div class="follower-item">
                        <a href="<?php echo generate_profile_url($item); ?>">
                            <img src="<?php echo get_user_avatar($item); ?>" alt="<?php echo get_shop_name($item); ?>"
                                class="img-fluid img-profile lazyload">
                            <p class="username">
                                <?php echo get_shop_name($item); ?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="tab-pane <?php echo ($active_tab == 'following') ? $active_classes : ''; ?>" id="tab-content-following">
        <div class="profile-tab-content">
            <div class="row py-3">
                <?php foreach ($following_users as $item): ?>
                <div class="col-4 col-sm-2">
                    <div class="follower-item">
                        <a href="<?php echo generate_profile_url($item); ?>">
                            <img src="<?php echo get_user_avatar($item); ?>" alt="<?php echo get_shop_name($item); ?>"
                                class="img-fluid img-profile lazyload">
                            <p class="username">
                                <?php echo get_shop_name($item); ?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="tab-pane <?php echo ($active_tab == 'reviews') ? $active_classes : ''; ?>" id="tab-content-reviews">
    <div class="profile-tab-content">
        <div id="user-review-result" class="user-reviews">
            <?php $this->load->view('profile/_user_reviews'); ?>
        </div>
    </div>
</div>