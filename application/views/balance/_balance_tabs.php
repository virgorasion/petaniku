<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs order-tabs">
    <ul class="nav nav-tabs" role="tablist" id="nav-profile-tabs">
        <li class="nav-item">
			<a
				class="nav-link <?php echo ($_SESSION['active_tab'] == 'earnings') ? 'active' : ''; ?>"
				href="<?php echo lang_base_url() . "balances/"; ?>"
				data-target="#tab-content-earnings"
                data-toggle="tab"
                role="tab">
				<span>Mutasi</span>
			</a>
		</li>
        <li class="nav-item">
			<a
				class="nav-link <?php echo ($_SESSION['active_tab'] == 'deposit') ? 'active' : ''; ?>"
				href="<?php echo lang_base_url() . "balances/deposit"; ?>"
				data-target="#tab-content-deposit"
                data-toggle="tab"
                role="tab">
				<span>Deposit</span>
			</a>
		</li>
        <li class="nav-item">
			<a
				class="nav-link <?php echo ($_SESSION['active_tab'] == 'payouts') ? 'active' : ''; ?>"
				href="<?php echo lang_base_url() . "balances/payouts"; ?>"
				data-target="#tab-content-payouts"
                data-toggle="tab"
                role="tab">
				<span>Withdraw</span>
			</a>
		</li>
    </ul>
</div>