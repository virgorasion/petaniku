<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1 class="product-title"><?php echo html_escape($product->title); ?></h1>
<?php if ($product->status == 0): ?>
	<label class="badge badge-warning badge-product-status"><?php echo trans("pending"); ?></label>
<?php elseif ($product->visibility == 0): ?>
	<label class="badge badge-danger badge-product-status"><?php echo trans("hidden"); ?></label>
<?php endif; ?>
<!-- <div class="row-custom meta">
	<?php echo trans("by"); ?>&nbsp;<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>"><?php echo character_limiter(get_shop_name_product($product), 30, '..'); ?></a>
	<?php if ($general_settings->product_reviews == 1): ?>
		<span><i class="icon-comment"></i><?php echo html_escape($comment_count); ?></span>
	<?php endif; ?>
	<span><i class="icon-heart"></i><?php echo get_product_favorited_count($product->id); ?></span>
	<span><i class="icon-eye"></i><?php echo html_escape($product->hit); ?></span>
</div> -->
<div class="row-custom price">
	<?php if ($product->listing_type != 'bidding'): ?>
		<?php if ($product->is_sold == 1): ?>
			<strong class="lbl-price" style="color: #9a9a9a;"><?php echo print_price($product->price, $product->currency); ?><span class="price-line"></span></strong>
			<strong class="lbl-sold"><?php echo trans("sold"); ?></strong>
		<?php elseif ($product->is_free_product == 1): ?>
			<strong class="lbl-free"><?php echo trans("free"); ?></strong>
		<?php else: ?>
			<strong class="lbl-price"><?php echo print_price($product->price, $product->currency); ?></strong>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (auth_check()): ?>
		<button class="btn btn-contact-seller hidden" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
	<?php else: ?>
		<button class="btn btn-contact-seller hidden" data-toggle="modal" data-target="#loginModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
	<?php endif; ?>
</div>

<div class="row-custom details">
	<!-- <?php if (!empty($product->product_condition)): ?>
		<div class="item-details">
			<div class="left">
				<label><?php echo trans("condition"); ?></label>
			</div>
			<div class="right">
				<?php $product_condition = get_product_condition_by_key($product->product_condition, $selected_lang->id);
				if (!empty($product_condition)):?>
					<span><?php echo html_escape($product_condition->option_label); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?> -->
	<div class="item-details">
		<div class="left">
			<label>Kepemilikan</label>
		</div>
		<div class="right">
			<span><?php echo $product->luas_lahan; ?></span>
		</div>
	</div>
	<?php if($product->estimasi_panen): ?>
	<div class="item-details">
		<div class="left">
			<label>Estimasi Panen</label>
		</div>
		<div class="right">
			<span><?php echo hitung_waktu($product->estimasi_panen); ?></span>
		</div>
	</div>	
	<?php endif; ?>
	<div class="item-details">
		<div class="left">
			<label>Per Slot</label>
		</div>
		<div class="right">
			<span><?php echo $product->per_slot; ?></span>
		</div>
	</div>
	<div class="item-details">
		<div class="left">
			<label><?php echo trans("uploaded"); ?></label>
		</div>
		<div class="right">
			<span><?php echo \Carbon\Carbon::parse($product->created_at)->diffForHumans(); ?></span>
		</div>
	</div>
	<?php
	if ($product->country_id != 0): 
		$CI =& get_instance();
		$CI->load->model('locationid_model');

		$kecamatan = $CI->locationid_model->get_kecamatan($product->address);
		$state = $CI->locationid_model->get_state($product->state_id);
		$city = $CI->locationid_model->get_city($product->city_id);
						
	?>
		<div class="item-details">
			<div class="left">
				<label><?php echo trans("district"); ?></label>
			</div>
			<div class="right">
				<span><?php echo empty($kecamatan) ? '' : $kecamatan->name ?></span>
			</div>
		</div>
		<div class="item-details">
			<div class="left">
				<label><?php echo trans("city"); ?></label>
			</div>
			<div class="right">
				<span><?php echo empty($city) ? '' : $city->name ?></span>
			</div>
		</div>
		<div class="item-details">
			<div class="left">
				<label><?php echo trans("province"); ?></label>
			</div>
			<div class="right">
				<span><?php echo empty($state) ? '' : $state->name; ?></span>
			</div>
		</div>
	<?php endif; ?>
</div>

<!--Include buttons-->
<?php $this->load->view("product/details/_buttons", ['input_id_suffix' => 'ds', 'input_form_suffix' => '']); ?>

<!--Include social share-->
<?php $this->load->view("product/details/_product_share"); ?>
