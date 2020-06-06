<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs order-tabs">
    <?php /* Delete this commented code, please
    <ul class="nav">
        <li class="nav-item <?php echo ($active_tab == 'active_sales') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>sales">
                <span><?php echo trans("active_sales"); ?></span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'completed_sales') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>sales/completed-sales">
                <span><?php echo trans("completed_sales"); ?></span>
            </a>
        </li>
    </ul>
    */ ?>
    <ul class="nav nav-tabs" role="tablist" id="nav-profile-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab == 'active_sales') ? 'active' : ''; ?>"
                href="<?php echo lang_base_url() . "sales"; ?>" data-target="#tab-content-active_sales" data-toggle="tab"
                role="tab">
                <span><?php echo trans("active_sales"); ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab == 'completed_sales') ? 'active' : ''; ?>"
                href="<?php echo lang_base_url() . "sales/completed-sales"; ?>"
                data-target="#tab-content-completed_sales" data-toggle="tab" role="tab">
                <span><?php echo trans("completed_sales"); ?></span>
            </a>
        </li>
    </ul>
</div>