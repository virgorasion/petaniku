<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    .card-balance{
        margin-left: 0;
        margin-right: 0;
        background: #4E5FDB;
        color: #FFF;
    }
    .card-history{
        margin-left: 0;
        margin-right: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }
    .text-white {
        color: #FFF !important;        
    }
    .btn-deposit {
        color: #FFF !important;        
        border: 1px solid #FFF;
        text-transform: uppercase;
        font-weight: 800;        
        margin-right: 20px;
    }
    .btn-withdraw {
        background: #FFF;
        color: #4E5FDB !important; 
        text-transform: uppercase;
        font-weight: 800;        
    }
</style>

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
            </div>
        </div>

        <ul>
            <!-- <li>Update deposit</li>
            <li>Update withdraw</li> -->
            <!-- <li>Transaksi dg deposit</li> -->
            <!-- <li>Get all transaksi</li> -->
        </ul>


        <div class="card card-balance">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <a href="<?= base_url('balances') ?>">
                            <span class="text-muted text-white">Saldo</span>
                            <h3 class="text-white"><?= print_price($this->auth_user->balance, 'IDR') ?></h3>
                        </a>
                    </div>
                    <div class="col-md-4 text-right">
                    <?php /*
                        <div style="margin-top:10px">
                            <a href="<?= base_url('balances/deposit') ?>" class="btn btn-default btn-lg btn-deposit">
                                Isi Saldo
                            </a>
                            <a href="<?= base_url('balances/payouts') ?>" class="btn btn-default btn-lg btn-withdraw">
                                Pencairan Uang
                            </a>
                        </div>
                    */ ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="row-custom">
					<!-- load profile nav -->
					<?php $this->load->view("balance/_balance_tabs"); ?>
				</div>
			</div>

			<div class="col-sm-12 col-md-12">
				<div class="tab-content" id="profile-tab-contents">
					<?php $this->load->view("balance/_balance_tab_contens"); ?>
				</div>
			</div>
		</div>       
    </div>
</div>
<!-- Wrapper End-->

