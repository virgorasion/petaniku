<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="product-item card card-1">
	<div class="row-custom">
		<a class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
		<!-- <a href="<?php echo generate_product_url($product); ?>"> -->
			<div class="img-product-container img-product-container-homepage">
				<div class="owl-carousel main-slider product-image-slider">
					<?php
					 $product_video = $this->file_model->get_product_video($product->id);
					
					 if (!empty($product_video)):
						?>
						<div class="item">
							<video height="200" width="100%" style="object-fit: cover" loop>
								<source src="<?php echo get_product_video_url($product_video); ?>" type="video/mp4">
								Your browser does not support HTML video.
							</video>
							<i class="icon-pause product-video-toggle"></i>
							<i class="icon-play product-video-toggle"></i>
						</div>
					<?php endif; ?>

					<?php 
					$product_images = $this->file_model->get_product_images($product->id);

					foreach ($product_images as $image):
						$img_slider_mobile = get_product_image_url($image, 'image_small');?>
						<div class="item">
							<img style="height:200px;object-fit:cover" data-src="<?= $img_slider_mobile; ?>" class="owl-lazy owl-image img-main-slider">
							<img style="height:200px;object-fit:cover" data-src="<?= $img_slider_mobile; ?>" class="owl-lazy owl-image img-main-slider-mobile">
						</div>
					<?php endforeach; ?>
				</div>
				<!-- <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'"> -->
			</div>
		<!-- </a> -->
		<?php if ($product->is_promoted && $promoted_products_enabled == 1 && isset($promoted_badge) && $promoted_badge == true): ?>
			<span class="badge badge-dark badge-promoted"><?php echo trans("promoted"); ?></span>
		<?php endif; ?>
	</div>
	<div class="row-custom item-details card-body">
		<h2	 class="product-title">
			<a href="<?php echo generate_product_url($product); ?>"><?php echo html_escape($product->title); ?></a>
		</h2>
		<!-- <p class="product-user text-truncate">
			<a href="<?php echo lang_base_url() . "profile" . '/' . html_escape($product->user_slug); ?>">
				<?php echo get_shop_name_product($product); ?>
			</a>
		</p>
		<?php if ($general_settings->product_reviews == 1) {
			$this->load->view('partials/_review_stars', ['review' => $product->rating]);
		} ?>
		<div class="item-meta">
			<?php $this->load->view('product/_price_product_item', ['product' => $product]); ?>
			<?php if ($general_settings->product_reviews == 1): ?>
				<span class="item-comments"><i class="icon-comment"></i>&nbsp;<?php echo get_product_comment_count($product->id); ?></span>
			<?php endif; ?>
			<span class="item-favorites"><i class="icon-heart-o"></i>&nbsp;<?php echo get_product_favorited_count($product->id); ?></span>
		</div> -->
		<!-- <br><br><br> -->
		<br><br><br>
		<table class="table table-product-card" style="margin:0">
			<tr>
				<td>Kepemilikan: </td>
				<td class="text-right"><span class="text-orange"><?= $product->luas_lahan ?></span></td>
			</tr>
			<tr>
				<td>Dibuka: </td>
				<td class="text-right"><span class="text-orange"><?= $product->quantity ?> Slot</span></td>
			</tr>
			<tr>
				<td>Tiap Slot: </td>
				<td class="text-right text-nowrap"><span class="text-orange"><?= $product->per_slot ?></span></td>
			</tr>
			<tr>
				<td>Est Panen: </td>
				<td class="text-right"><span class="text-orange"><?= hitung_waktu($product->estimasi_panen); ?></span></td>
			</tr>
			<tr>
				<td>Lokasi: </td>
				<td class="text-right"><span class="text-orange">
					<?= get_location_home($product) ?>
				</span></td>
			</tr>
			<tr>
				<td>Diposting: </td>
				<td class="text-right"><span class="text-orange"><?= \Carbon\Carbon::parse($product->created_at)->diffForHumans() ?></span></td>
			</tr>
			<tr>
				<td><span class="text-green"><strong>Terjual</strong></span></td>
				<?php 
					$terjual = $this->order_model->get_terjual_product($product->id);
					$stok = $product->quantity + $terjual;
					$persentase = ceil($terjual/$stok);
				?>
				<td class="text-right"><span class="text-green"><?= $persentase ?>%</span></td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?= $persentase ?>%" aria-valuenow="<?= $persentase ?>" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">
					<span class="text-orange" style="font-size:18px">
						<strong><?php echo print_price($product->price, $product->currency); ?></strong> / Slot
					</span>
				</td>
			</tr>
		</table>
		<hr>
		<div class="row">
			<div class="col-sm-3">
				<img style="width:45px;height:45px;border-radius:50%" src="<?= get_user_avatar_from_product($product) ?>"/>
			</div>
			<div class="col-sm-9">
				<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>"><?php echo character_limiter(get_shop_name_product($product), 30, '..'); ?></a>
				<div class="row-custom review-total">
					<?php $this->load->view('partials/_review_stars', ['review' => get_user_rating_from_all_product($product->user_id)]); ?>
					<span>(<?php echo get_count_user_rating_from_all_product($product->user_id); ?>)</span>
				</div>
				<br>
				<div style="display:inline-block">
					<small><?= get_user_products_count(get_user($product->user_id)->slug) ?> Proyek</small>
				</div>
			</div>
		</div>
	</div>
</div>