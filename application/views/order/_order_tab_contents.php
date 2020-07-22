<?php
$active_classes = 'fade active show';
?>

<div class="tab-pane <?php echo ($active_tab == 'active_orders') ? $active_classes : ''; ?>"
    id="tab-content-active_orders">
    <div class="order-tab-content">
        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>
        <?php $this->load->view('order/_order_filters'); ?>
        <div class="table-responsive">
            <table class="table table-orderlist">
                <thead>
                    <tr>
                        <th scope="col"><?php echo trans("order"); ?></th>
                        <th scope="col"><?php echo trans("buyer"); ?></th>
                        <th scope="col"><?php echo trans("total"); ?></th>
                        <th scope="col" class="hidden"><?php echo trans("payment"); ?></th>
                        <th scope="col"><?php echo trans("date"); ?></th>
                        <th scope="col"><?php echo trans("status"); ?></th>
                        <th scope="col"><?php echo trans("options"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($orders)):
                        foreach ($orders as $order):
                            $buyer = get_user($order->buyer_id);
                            ?>
                            <tr>
                                <td>#<?php echo $order->order_number; ?></td>
                                <td>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <img src="<?php echo get_user_avatar($buyer); ?>" alt="buyer" class="rounded-circle img-responsive" style="height: 40px;">
                                        </div>
                                        <div class="col pl-3">
                                            <?php echo html_escape($buyer->username); ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo print_price($order->price_total, $order->price_currency); ?></td>
                                <td class="hidden">
                                    <?php if ($order->payment_status == 'payment_received'):
                                        echo trans("payment_received");
                                    else:
                                        echo trans("awaiting_payment");
                                    endif; ?>
                                </td>
                                <td><?php echo date("Y-m-d / h:i", strtotime($order->created_at)); ?></td>
                                <td>
                                    <?php
                                    $label_classes = 'badge-status-default';
                                    $label_text = trans($order->payment_status);

                                    if (in_array($order->payment_status, ['payment_received'])) {
                                        $label_classes = 'badge-status-success';
                                    }
                                    ?>
                                    <div class="badge-status <?php echo $label_classes; ?>">
                                        <strong><?php echo $label_text; ?></strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo lang_base_url(); ?>order/<?php echo html_escape($order->order_number); ?>"
                                        class="btn btn-primary order-detail-btn" data-id="<?php echo $order->order_number; ?>"
                                        data-title="#<?php echo $order->order_number; ?>"><?php echo trans('details'); ?></a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    else: ?>
                        <tr>
                            <td colspan="7">
                                <p class="m-0 py-3 text-center">
                                    <?php echo trans("no_records_found"); ?>
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-auto justify-self-end">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<div class="tab-pane <?php echo ($active_tab == 'completed_orders') ? $active_classes : ''; ?>"
    id="tab-content-completed_orders">
    <div class="order-tab-content">
        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>
        <?php $this->load->view('order/_order_filters'); ?>
        <div class="table-responsive">
            <table class="table table-orderlist">
                <thead>
                    <tr>
                        <th scope="col"><?php echo trans("order"); ?></th>
                        <th scope="col"><?php echo trans("buyer"); ?></th>
                        <th scope="col"><?php echo trans("total"); ?></th>
                        <th scope="col"><?php echo trans("date"); ?></th>
                        <!-- <th scope="col"><?php //echo trans("date"); ?></th> -->
                        <th scope="col"><?php echo trans("status"); ?></th>
                        <th scope="col"><?php echo trans("options"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($completed_orders)):
                            foreach ($completed_orders as $order):
                                $buyer = get_user($order->buyer_id);
                                ?>
                                <tr>
                                    <td>#<?php echo $order->order_number; ?></td>
                                    <td>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <img src="<?php echo get_user_avatar($buyer); ?>" alt="buyer"
                                                    class="rounded-circle img-responsive" style="height: 40px;">
                                            </div>
                                            <div class="col pl-3">
                                                <?php echo html_escape($buyer->username); ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo print_price($order->price_total, $order->price_currency); ?></td>
                                    <td class="hidden">
                                        <?php if ($order->payment_status == 'payment_received'):
                                            echo trans("payment_received");
                                        else:
                                            echo trans("awaiting_payment");
                                        endif; ?>
                                    </td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($order->created_at)); ?></td>
                                    <td>
                                        <?php
                                        $label_classes = 'badge-status-default';
                                        $label_text = trans($order->payment_status);

                                        if (in_array($order->payment_status, ['payment_received','completed'])) {
                                            $label_classes = 'badge-status-success';
                                        }
                                        ?>
                                        <div class="badge-status <?php echo $label_classes; ?>">
                                            <strong><?php echo $label_text; ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo lang_base_url(); ?>order/<?php echo html_escape($order->order_number); ?>"
                                            class="btn btn-primary order-detail-btn" data-id="<?php echo $order->order_number; ?>"
                                            data-title="#<?php echo $order->order_number; ?>"><?php echo trans('details'); ?></a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else: ?>
                        <tr>
                            <td colspan="7">
                                <p class="m-0 py-3 text-center">
                                    <?php echo trans("no_records_found"); ?>
                                </p>
                            </td>
                        </tr>
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-auto justify-self-end">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<style type="text/css">
/** Sweet Alert **/
.swal2-title {
font-size: 1.5rem;
}

.swal2-content {
font-size: 1rem;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
(function($) {
    $(document).ready(function() {
        $('.order-detail-btn').on('click', function(event) {
            event.preventDefault();

            var button = $(event.target);
            var id = button.data('id') || 0;
            var title = button.data('title') || 0;

            Swal.fire({
                title: 'Loading Order '+title,
                onBeforeOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        method: 'get',
                        url: '<?php echo lang_base_url(); ?>order/'+id,
                        data: {
                            is_ajax: 'yes',
                        },
                        success: function(data) {
                            var result = JSON.parse(data);

                            if ('success' === result.status) {
                                Swal.fire({
                                    title: '',
                                    // title: 'Detail Order '+title,
                                    html: result.html,
                                    width: '840px',
                                    scrollbarPadding: false,
                                    showCloseButton: true,
                                    showClass: {
                                        popup: 'animate__animated animate__fadeIn animate__faster'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOut animate__faster'
                                    }
                                });
                            }
                        }
                    });
                }
            });
        })
    })
})(jQuery);
</script>