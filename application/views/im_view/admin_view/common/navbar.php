<?php

?>
<body>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">

    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <a class="navbar-brand" href="./"><i class="fa fa-comments" style="padding-right: 10px; font-size: inherit"></i><span>Chat Manager</span></a>

        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?php echo base_url("imadmin/dashboard") ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">Options</h3><!-- /.menu-title -->
                <li class=" dropdown">
                    <a href="<?php echo base_url('imadmin/user')?>" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-user"></i>Users</a>
                </li>
                <li class=" dropdown">
                    <a href="<?php echo base_url('imadmin/messengerOptions')?>" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-envelope-o"></i>Messenger Option</a>
                </li>

                <h3 class="menu-title">Settings</h3><!-- /.menu-title -->

                <li class=" dropdown">
                    <a href="<?php echo base_url('imadmin/adminsettings') ?>" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>Admin Settings</a>
                </li>
                <li class=" dropdown">
                    <a id="logoutButton" href="#" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-back-left"></i>Log Out</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->

    </nav>

</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->
<script type="text/javascript">

    jQuery(document).ready(function($) {
        $('#logoutButton').on("click",function () {
            localStorage.removeItem("_r");
            location.href="<?php echo base_url('imadmin/logout'); ?>";
        });
    });
</script>
<div id="right-panel" class="right-panel">
