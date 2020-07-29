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