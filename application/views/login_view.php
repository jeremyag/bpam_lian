<html>
    <head>
        <title>BPAM - Lian</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome/css/fontawesome.min.css">

        <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.slim.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <br>
                    <?php if($this->session->flashdata('login_errors')): ?>
                        <div class="alert alert-danger"><?=$this->session->flashdata('login_errors')?></div>
                    <?php endif;?>
                    <?php echo form_open(add_index().'Account_Controller/login'); ?>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            Log in
                        </div>
                        <div class="card-body">
                            <h4 class="alert alert-info">Business Permit Applications Manager - <?=$this->General_Settings_Model->get_municipality()->settings_value?> Municipality</h4>
                            <br>
                            <div class="form-group">
                                <?php
                                    echo form_label('Username:');
                                    echo form_input(array(
                                        'class'=>'form-control',
                                        'name'=>'form_username',
                                        'placeholder'=> 'Username'
                                    ));
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    echo form_label('Password');
                                    echo form_password(array(
                                       'class'=>'form-control',
                                       'name'=>'form_password',
                                        'placeholder'=>'Password'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <?php echo form_submit(array(
                                        'class'=>'btn btn-primary btn-lg',
                                        'value'=>'Log in'
                                ));?>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>