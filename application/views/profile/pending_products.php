<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("profile"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="profile-page-top">
                    <!-- load profile details -->
                    <?php $this->load->view("profile/_profile_user_info"); ?>
                </div>
            </div>
        </div>

<?php 
            $col_nav = "3";
            $col_content = "9";

            if(auth_check()){
                if (user()->id != $user->id){
                    $col_nav = "12";
                    $col_content = "12";                    
                }
            } else {
                $col_nav = "12";
                $col_content = "12";  
            }
        ?>

        <div class="row">
            <div class="col-sm-12 col-md-<?= $col_nav ?>">
                <!-- load profile nav -->
                <?php if(auth_check()): ?>
                    <?php if (user()->id != $user->id): ?>                
                        <?php $this->load->view("profile/_profile_tabs"); ?>
                    <?php else: ?>
                        <?php $this->load->view("profile/_profile_tabs_normal"); ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php $this->load->view("profile/_profile_tabs"); ?>
                <?php endif; ?>
            </div>

            <div class="col-sm-12 col-md-<?= $col_content ?>">
                <div class="profile-tab-content">
                    <?php if (auth_check() && user()->id == $user->id):
                        foreach ($products as $product):
                            $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                        endforeach;
                    else: ?>
                        <div class="row row-product-items">
                            <!--print products-->
                            <?php foreach ($products as $product): ?>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                    <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-list-pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>

