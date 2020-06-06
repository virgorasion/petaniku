<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Wrapper -->
<div id="wrapper" class="index-wrapper">
	<div class="container container-slider">
		<div class="row">
			<div class="col-sm-3">
				<div class="card" style="margin:0">
					<div class="card-body text-center">
						<br>
						<br>
						<h5>Selamat Datang di Petaniku</h5>
						<p>Jual beli online aman dan nyaman</p>
						<button class="btn btn-block btn-primary">Lihat cara kerjanya</button>
						<br>
						<br>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<?php if (!empty($slider_items) && $general_settings->index_slider == 1): ?>
					<div class="section section-slider">
						<!-- main slider -->
						<?php $this->load->view("partials/_main_slider"); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<h1 class="index-title"><?php echo html_escape($settings->site_title); ?></h1>
			<?php if ($featured_category_count > 0 && $general_settings->index_categories == 1): ?>
				<div class="col-12 section section-categories">
					<!-- featured categories -->
					<?php $this->load->view("partials/_featured_categories"); ?>
				</div>
			<?php endif; ?>
			<div class="col-12">
				<div class="row-custom row-bn">
					<!--Include banner-->
					<?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_1", "class" => ""]); ?>
				</div>
			</div>
			<?php if ($general_settings->index_promoted_products == 1 && $promoted_products_enabled == 1 && !empty($promoted_products)): ?>
				<div class="col-12 section section-promoted">
					<!-- promoted products -->
					<?php $this->load->view("product/_promoted_products"); ?>
				</div>
			<?php endif; ?>
			<?php if ($general_settings->index_latest_products == 1 && !empty($latest_products)): ?>
				<div class="col-12 section section-latest-products">
					<div class="row">
						<div class="col-md-6" style="padding-left:30px">
							<h3 class="title" style="text-align:left"><?php echo trans("latest_products"); ?></h3>
							<p class="title-exp" style="text-align:left"><?php echo trans("latest_products_exp"); ?></p>
						</div>
						<div class="col-md-6 text-right">
							<a href="<?= base_url('products') ?>" class="btn btn-primary btn-dark">EXPLORE</a>
						</div>
					</div>
					<div class="row row-product">
						<!--print products-->
						<?php foreach ($latest_products as $product): ?>
							<div class="col-6 col-sm-6 col-md-4 col-lg-25 col-product">
								<?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => false]); ?>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="row row-product" id="template-homepage-product">
					</div>

					<div class="row-custom text-center">
						<a href="javascript:void(0)" data-page="1" class="loadmore-homepage link-see-more"><span><?php echo trans("see_more"); ?>&nbsp;</span><i class="icon-arrow-right"></i></a>
						<!-- <a href="<?php echo lang_base_url() . "products"; ?>" class="link-see-more"><span><?php echo trans("see_more"); ?>&nbsp;</span><i class="icon-arrow-right"></i></a> -->
					</div>
				</div>
			<?php endif; ?>
			<div class="col-12">
				<div class="row-custom row-bn">
					<!--Include banner-->
					<?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_2", "class" => ""]); ?>
				</div>
			</div>
			<?php if ($general_settings->index_blog_slider == 1 && !empty($blog_slider_posts)): ?>
				<div class="col-12 section section-blog m-0">
					<h3 class="title"><?php echo trans("latest_blog_posts"); ?></h3>
					<p class="title-exp"><?php echo trans("latest_blog_posts_exp"); ?></p>
					<div class="row-custom">
						<!-- main slider -->
						<?php $this->load->view("blog/_blog_slider", ['blog_slider_posts' => $blog_slider_posts]); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- Wrapper End-->
<script>
	var $owlproduct;
	$('.loadmore-homepage').click(function(){
		let max_tampil = <?= $this->general_settings->index_latest_products_count ?>;
		let page = $(this).data('page');
		
		var data = {
			"page": page
		};
		data[csfr_token_name] = $.cookie(csfr_cookie_name);
		$.ajax({
			type: "POST",
			url: base_url + "loadmore-product",
			data: data,
    		dataType:'json',
			success: function (response) {
				$('.loadmore-homepage').data('page', page+1);			
                $("#template-homepage-product").append(response.view);						
				init_carousel_product();
				
				if(response.total < max_tampil) {
					$('.loadmore-homepage').addClass('hidden');
				}
			}
		});
	})
</script>


