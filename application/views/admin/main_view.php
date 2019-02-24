<html>
<head>
    <title>BPAM - Lian Municipality: Administrator</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bpm_lian.css">

    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 1; width: 100%; position: fixed;">
    <a class="navbar-brand" href="<?php echo base_url()?>admin">BPAM - Lian Municipality</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>admin"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>admin/applications"><i class="fa fa-file"></i> Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>admin/businesses"><i class="fa fa-building"></i> Businesses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>admin/accounts"><i class="fa fa-users"></i> Accounts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>admin/settings"><i class="fa fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-row-reverse">
        <a class="p-2 btn btn-danger" href="<?php echo base_url();?>admin/step1">New Application</a>
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
</div>
</body>
</html>