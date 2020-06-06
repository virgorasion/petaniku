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
                        <div style="margin-top:10px">
                            <a href="<?= base_url('balances/deposit') ?>" class="btn btn-default btn-lg btn-deposit">
                                Isi Saldo
                            </a>
                            <a href="<?= base_url('balances/payouts') ?>" class="btn btn-default btn-lg btn-withdraw">
                                Pencairan Uang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <strong class="text-muted">Histori Anda</strong>

        <?php foreach ($hist as $row): ?>
        <div class="card card-history">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php if($row['type'] == "order" || $row['type'] == "terjual"): ?>
                        <a target="_blank" href="<?= base_url('order/'.$row['order_number']) ?>">
                            <span class="text-muted"><?= ucfirst($row['type']) ?> #<?= $row['order_number'] ?></span>                        
                        </a>
                        <?php else: ?>
                        <span class="text-muted"><?= ucfirst($row['type']) ?></span>                                                
                        <?php endif;?>

                        <h5 style="margin-top:10px"><?= $row['title'] ?></h5>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="text-muted">
                            <?php echo \Carbon\Carbon::parse($row['created_at'])->diffForHumans() ?>
                        </div>
                        <div style="margin-top:10px">
                            <?php if($row['sign'] == "min"): ?>
                                <h5 class="text-danger">- <?= print_price($row['amount'], $row['currency']) ?></h5>
                            <?php elseif($row['sign'] == "plus"): ?>
                                <h5 class="text-success">+ <?= print_price($row['amount'], $row['currency']) ?></h5>
                            <?php else: ?>
                                <h5><?= print_price($row['amount'], $row['currency']) ?></h5>                            
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>        

    </div>
</div>
<!-- Wrapper End-->

