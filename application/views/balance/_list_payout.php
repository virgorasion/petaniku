<div class="table-responsive">
    <table class="table table-orders table-striped">
        <thead>
        <tr>
            <th scope="col"><?php echo trans("withdraw_method"); ?></th>
            <th scope="col"><?php echo trans("withdraw_amount"); ?></th>
            <th scope="col"><?php echo trans("status"); ?></th>
            <th scope="col"><?php echo trans("date"); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($payouts as $payout): ?>
            <tr>
                <td>Bank Transfer</td>
                <td><?php echo print_price($payout->amount, $payout->currency); ?></td>
                <td>
                    <?php if ($payout->status == 1) {
                        echo trans("completed");
                    } else {
                        echo trans("pending");
                    } ?>
                </td>
                <td><?php echo date("Y-m-d / h:i", strtotime($payout->created_at)); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (empty($payouts)): ?>
    <p class="text-center">
        <?php echo trans("no_records_found"); ?>
    </p>
<?php endif; ?>
<div class="row-custom m-t-15">
    <div class="float-right">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>