<html>
<head>
    <title>BPAM - <?=$this->General_Settings_Model->get_municipality()->settings_value?> Municipality: Administrator</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bpm_lian.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/Chart.min.css">

    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-3.4.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>
    <script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 1; width: 100%; position: fixed;">
    <a class="navbar-brand" href="<?php echo base_url().add_index()?>admin">BPAM - <?=$this->General_Settings_Model->get_municipality()->settings_value?> Municipality</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index(); ?>admin"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index(); ?>admin/applications"><i class="fa fa-file"></i> Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index(); ?>admin/businesses"><i class="fa fa-building"></i> Businesses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index()?>admin/accounts"><i class="fa fa-users"></i> Accounts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index()?>admin/settings"><i class="fa fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url().add_index()?>admin/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-row-reverse">
        <a class="p-2 btn btn-danger" href="<?php echo base_url().add_index();?>admin/step1">New Application</a>
    </div>
</nav>
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
        $this->load->view($view);
    ?>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="text-right">
                <p><small>Business Permit Applications Manager v0.0</small></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<form id="gModal-form" method="post">
<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="gModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="action-page">
                <div class="modal-header">
                    <h5 class="modal-title" id="gModal-head">General Action Modal</h5>
                </div>
                <div class="modal-body">
                <div id="g-loading" class="text-center">
                    <img src="<?=base_url()?>/assets/img/loading.gif"/>
                </div>
                <div id="gModal-body"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="gModal-cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" id="gModal-continue">Continue</button>
            </div>
        </div>
    </div>
</div>
</form>