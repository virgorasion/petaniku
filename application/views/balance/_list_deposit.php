<div class="table-responsive">
    <table class="table table-orders table-striped">
        <thead>
        <tr>
            <th scope="col">Jumlah Pengisian</th>
            <th scope="col">Nominal Transfer</th>
            <th scope="col"><?php echo trans("status"); ?></th>
            <th scope="col"><?php echo trans("date"); ?></th>
            <th scope="col"><?php echo trans("options"); ?></th>
        </tr>
        </thead>
        <tbody id="table_deposit">
        <?php foreach ($deposit as $row): ?>
            <tr>
                <td><?php echo print_price($row->amount, $row->currency); ?></td>
                <td><?php 
                $tf = ($row->transfer) ? $row->transfer : $row->amount;
                echo print_price($tf, $row->currency); ?></td>
                <td>
                    <?php if ($row->status == 1) {
                        echo trans("completed");
                    } else {
                        echo trans("pending");
                    } ?>
                </td>
                <td><?php echo date("Y-m-d / h:i", strtotime($row->created_at)); ?></td>
                <td>
                    <?php if($row->status == 0): ?>
                    <button class="btn btn-md btn-custom" data-toggle="modal" data-target="#infoPaymentModal<?= $row->id ?>">Informasi Transfer</button>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (empty($deposit)): ?>
    <p class="text-center">
        <?php echo trans("no_records_found"); ?>
    </p>
<?php endif; ?>
<div class="row-custom m-t-15">
    <div class="float-right">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<?php foreach($deposit as $row): 
$transactions = $this->transaction_model->get_transaction_payment_id($row->id);    
?>
<div class="modal fade" id="infoPaymentModal<?=$row->id?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-custom">
			<!-- form start -->
			<div class="modal-header">
				<h5 class="modal-title"><?php echo trans("transfer_info"); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
            <?= form_open("balance_controller/confirmation_deposit"); ?>
				<br><br>
				<h4 class=" text-center">
                <?php if($transactions->payment_status == "awaiting_payment"): ?>
				Silahkan melakukan transfer sebesar <br> <strong><?= "Rp".number_format($row->transfer/100,0,",",".") ?></strong>
                <?php else: ?>
				<span class="text-success">Telah melakukan transfer sebesar</span> <br> <strong><?= "Rp".number_format($row->transfer/100,0,",",".") ?></strong><br><span style="font-size:15px">(Menunggu Konfirmasi Admin)</span>
                <?php endif ?>
				</h4><br><br>
				<?php echo $payment_settings->bank_transfer_accounts; ?>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-toggle="modal" data-target="#insertPaymentModal"><?php //echo trans("report_bank_transfer"); ?></button>-->
                <?php if($transactions->payment_status == "awaiting_payment"): ?>
				<button type="button" onclick="info_transfer(<?= $row->id?>)" class="btn btn-sm btn-secondary color-white m-l-15"><?php echo trans("report_bank_transfer"); ?></button>
                <?php else: ?>				
				<button type="button" class="btn btn-sm btn-secondary color-white m-l-15" data-dismiss="modal"><?php echo trans("close"); ?></button>
                <?php endif ?>
            <?= form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>