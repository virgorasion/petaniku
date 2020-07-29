<?php foreach ($hist as $row): ?>
<div class="card card-history">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <?php if($row['type'] == "order" || $row['type'] == "terjual"): ?>
                <a target="_blank" href="<?= base_url('order/'.$row['order_number']) ?>">
                    <span class="text-muted"><?= ucfirst($row['type']) ?> #<?= $row['order_number'] ?> <?= (@$row['status'] == "cancelled")? "Dibatalkan": ""?></span>                        
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
                        <?php if(@$row['status'] == "cancelled"):?>
                            <h5 class="text-success">+ <?= print_price($row['amount'], $row['currency']) ?></h5>
                        <?php else: ?>
                            <h5 class="text-danger">- <?= print_price($row['amount'], $row['currency']) ?></h5>
                        <?php endif ?>
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
<div class="row-custom m-t-15">
    <div class="float-right">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>