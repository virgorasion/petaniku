<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<?php $data = $imData;
    //echo print_r($imData, 1);
?>
<div id="wrapper">
    <div class="container">
        <!-- <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("messages"); ?></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?php echo trans("messages"); ?></h1>
            </div>
        </div>
        <div class="row row-col-messages">
            
        </div> -->
        <?php 
            $this->load->view('message/header',$data);
            $this->load->view('message/im', $data);
            $this->load->view('message/header_script',$data);
            $this->load->view('message/im_footer', $data);
        ?>
    </div>
</div>

<!-- Wrapper End-->

