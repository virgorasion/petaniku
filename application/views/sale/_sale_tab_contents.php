<?php
$active_classes = 'fade active show';
?>

<div class="tab-pane <?php echo ($active_tab == 'active_sales') ? $active_classes : ''; ?>"
    id="tab-content-active_sales">
    <div class="order-tab-content">
        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>
        <?php $this->load->view('sale/_sale_filters'); ?>
        <div class="table-responsive">
            <table class="table table-orderlist">
                <thead>
                    <tr>
                        <th scope="col"><?php echo trans("sale"); ?></th>
                        <th scope="col"><?php echo trans("total"); ?></th>
                        <th scope="col"><?php echo trans("payment"); ?></th>
                        <th scope="col"><?php echo trans("status"); ?></th>
                        <th scope="col"><?php echo trans("date"); ?></th>
                        <th scope="col"><?php echo trans("options"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($orders)):
                        foreach ($orders as $order):
                            $sale = get_order($order->id);
                            $total = $this->order_model->get_seller_total_price($order->id);
                            if (!empty($sale)):?>
                                <tr>
                                    <td>#<?php echo $sale->order_number; ?></td>
                                    <td><?php echo print_price($total, $sale->price_currency); ?></td>
                                    <td>
                                        <?php if ($sale->payment_status == 'payment_received'):
                                            echo trans("payment_received");
                                        else:
                                            echo trans("awaiting_payment");
                                        endif; ?>
                                    </td>
                                    <td>
                                        <strong class="font-600">
                                            <?php
                                            if ($sale->payment_status == 'awaiting_payment'):
                                                if ($sale->payment_method == 'Cash On Delivery') {
                                                    echo trans("order_processing");
                                                } else {
                                                    echo trans("awaiting_payment");
                                                }
                                            else:
                                                if ($active_tab == "active_sales"):
                                                    echo trans("order_processing");
                                                else:
                                                    echo trans("completed");
                                                endif;
                                            endif; ?>
                                        </strong>
                                    </td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($sale->created_at)); ?></td>
                                    <td>
                                        <a href="<?php echo lang_base_url(); ?>sale/<?php echo $sale->order_number; ?>"
                                            class="btn btn-sm btn-table-info"><?php echo trans("details"); ?></a>
                                    </td>
                                </tr>
                                <?php
                            endif;
                        endforeach;
                    else: ?>
                        <tr>
                            <td colspan="6">
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

<div class="tab-pane <?php echo ($active_tab == 'completed_sales') ? $active_classes : ''; ?>"
    id="tab-content-completed_sales">
    <div class="order-tab-content">
        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>
        <?php $this->load->view('sale/_sale_filters'); ?>
        <div class="table-responsive">
            <table class="table table-orderlist">
                <thead>
                    <tr>
                        <th scope="col"><?php echo trans("sale"); ?></th>
                        <th scope="col"><?php echo trans("total"); ?></th>
                        <th scope="col"><?php echo trans("payment"); ?></th>
                        <th scope="col"><?php echo trans("status"); ?></th>
                        <th scope="col"><?php echo trans("date"); ?></th>
                        <th scope="col"><?php echo trans("options"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($completed_orders)):
                            foreach ($completed_orders as $order):
                                $sale = get_order($order->id);
                                $total = $this->order_model->get_seller_total_price($order->id);
                                if (!empty($sale)):
                                    ?>
                                    <tr>
                                        <td>#<?php echo $sale->order_number; ?></td>
                                        <td><?php echo print_price($total, $sale->price_currency); ?></td>
                                        <td>
                                            <?php if ($sale->payment_status == 'payment_received'):
                                                echo trans("payment_received");
                                            else:
                                                echo trans("awaiting_payment");
                                            endif; ?>
                                        </td>
                                        <td>
                                            <strong class="font-600">
                                                <?php
                                                if ($sale->payment_status == 'awaiting_payment'):
                                                    if ($sale->payment_method == 'Cash On Delivery') {
                                                        echo trans("order_processing");
                                                    } else {
                                                        echo trans("awaiting_payment");
                                                    }
                                                else:
                                                    if ($active_tab == "active_sales"):
                                                        echo trans("order_processing");
                                                    else:
                                                        echo trans("completed");
                                                    endif;
                                                endif; ?>
                                            </strong>
                                        </td>
                                        <td><?php echo date("Y-m-d / h:i", strtotime($sale->created_at)); ?></td>
                                        <td>
                                            <a href="<?php echo lang_base_url(); ?>sale/<?php echo $sale->order_number; ?>"
                                                class="btn btn-sm btn-table-info"><?php echo trans("details"); ?></a>
                                        </td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                        else: ?>
                    <tr>
                        <td colspan="6">
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
