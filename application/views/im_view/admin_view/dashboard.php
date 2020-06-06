<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 3/13/2017
 * Time: 1:38 PM
 */

?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1" style="border: none">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-users text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo $totalUser ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Total Users</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2" style="border: none">
            <div class="card-body bg-flat-color-5">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-user-plus text-light"></i>
                </div>
                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo $totalActiveUser ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Active Users</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-3" style="border: none">
            <div class="card-body bg-flat-color-1">
                <div class="h1 text-light text-right mb-4">
                    <i class="fa fa-comments-o"></i>
                </div>
                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo $totalMessage ?></span>
                </div>
                <small class="text-light text-uppercase font-weight-bold">Total Messages</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4" style="border: none">
            <div class="card-body bg-flat-color-3">
                <div class="h1 text-right text-light mb-4">
                    <i class="fa fa-users"></i>
                </div>
                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo $totalGroups ?></span>%
                </div>
                <small class="text-uppercase font-weight-bold text-light">Total Groups</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <h4 class="mb-3">MESSAGES </h4>
                <canvas id="lineChart" height="367" width="735" style="display: block; width: 735px; height: 367px;"></canvas>
            </div>
        </div>


    </div>


</div> <!-- .content -->
<!-- /#right-panel -->

<!-- Right Panel -->




<script src="<?php echo base_url('/assets/im/admin/js/lib/chart-js/Chart.bundle.js') ?>"></script>

<script>
    ( function ( $ ) {
        "use strict";

        // Counter Number
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 3000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

        //line chart
        var ctx = document.getElementById( "lineChart" );
        ctx.height = 150;
        var myChart = new Chart( ctx, {
            type: 'line',
            data: {
                labels: [ "January", "February", "March", "April", "May", "June", "July" ,"August","September","October","November","December"],
                datasets: [
                    {
                        label: "Total Monthly Status",
                        borderColor: "rgba(29, 33, 36)",
                        borderWidth: "1",
                        backgroundColor: "rgba(29, 33, 36, 0.7)",
                        pointHighlightStroke: "rgba(29, 33, 36)",
                        data: [
                            <?php if($chart[1]['month']==1){ ?>
                            <?php echo $chart[1]['total']?>,
                            <?php } else{ ?>
                            0,
                            <?php } ?>
                            <?php if($chart[2]['month']==2){ ?>
                            <?php echo $chart[2]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?>
                            <?php if($chart[3]['month']==3){ ?>
                            <?php echo $chart[3]['total']?>,
                            <?php } else{ ?>
                            0,
                            <?php } ?>
                            <?php if($chart[4]['month']==4){ ?>
                            <?php echo $chart[4]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?>

                            <?php if($chart[5]['month']==5){ ?>
                             <?php echo $chart[5]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[6]['month']==6){ ?>
                             <?php echo $chart[6]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[7]['month']==7){ ?>
                             <?php echo $chart[7]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[8]['month']==8){ ?>
                             <?php echo $chart[8]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[9]['month']==9){ ?>
                            <?php echo $chart[9]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[10]['month']==10){ ?>
                             <?php echo $chart[10]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[11]['month']==11){ ?>
                             <?php echo $chart[11]['total']?>,
                            <?php } else{ ?>
                             0,
                            <?php } ?><?php if($chart[12]['month']==12){ ?>
                            <?php echo $chart[12]['total']?>,
                            <?php } else{ ?>
                            0,
                            <?php } ?>
                        ]
                    },

                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }

            }
        } );

    } )( jQuery );
</script>
</div>
</body>