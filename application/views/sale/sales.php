<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="nav-breadcrumb" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
					</ol>
				</nav>

				<h1 class="page-title"><?php echo $title; ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="row-custom">
					<!-- load profile nav -->
					<?php $this->load->view("sale/_sale_tabs"); ?>
				</div>
			</div>

			<div class="col-sm-12 col-md-12">
				<div class="tab-content" id="profile-tab-contents">
					<?php $this->load->view("sale/_sale_tab_contents"); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Wrapper End-->

