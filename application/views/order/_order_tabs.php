<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs order-tabs">
    <ul class="nav nav-tabs" role="tablist" id="nav-profile-tabs">
        <li class="nav-item">
			<a
				class="nav-link <?php echo ($active_tab == 'active_orders') ? 'active' : ''; ?>"
				href="<?php echo lang_base_url() . "orders/"; ?>"
				data-target="#tab-content-active_orders"
                data-toggle="tab"
                role="tab">
				<span><?php echo trans("active_orders"); ?></span>
			</a>
		</li>
        <li class="nav-item">
			<a
				class="nav-link <?php echo ($active_tab == 'completed_orders') ? 'active' : ''; ?>"
				href="<?php echo lang_base_url() . "orders/completed-orders"; ?>"
				data-target="#tab-content-completed_orders"
                data-toggle="tab"
                role="tab">
				<span><?php echo trans("completed_orders"); ?></span>
			</a>
		</li>
    </ul>
</div>