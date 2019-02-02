<br>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-danger" href="<?php echo base_url()?>admin/accounts"><i class="fa fa-chevron-left"></i> Back</a>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h4>Register Account</h4>
            </div>
            <div class="card-body">
                <?php echo form_open(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <label>First name:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_first_name',
                            'placeholder'=>'First name'
                        )); ?>
                    </div>
                    <div class="col-md-4">
                        <label>Middle name:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_middle_name',
                            'placeholder'=>'Middle name'
                        )); ?>
                    </div>
                    <div class="col-md-4">
                        <label>Last name:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_last_name',
                            'placeholder'=>'Last name'
                        )); ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Username:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_username',
                            'placeholder'=>'Username'
                        ))?>
                        <br>
                        <label>Password:</label>
                        <?php echo form_password(array(
                            'class'=>'form-control',
                            'name'=>'form_password',
                            'placeholder'=>'Password'
                        ))?>
                        <br>
                        <label>Confirm Password:</label>
                        <?php echo form_password(array(
                            'class'=>'form-control',
                            'name'=>'form_confirm_password',
                            'placeholder'=>'Confirm Password'
                        ))?>
                        <br>
                        <label>Email:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_email',
                            'placeholder'=>'Email',
                            'type'=>'email'
                        ))?>
                        <br>
                        <label>Contact No.:</label>
                        <?php echo form_input(array(
                            'class'=>'form-control',
                            'name'=>'form_contact_no',
                            'placeholder'=>'Contact No.'
                        )) ?>
                    </div>
                </div>
                <br>
                <div class="text-right">
                    <?php echo form_submit(array(
                        'class'=>'btn btn-danger',
                        'value'=>'Submit',
                        'name'=>'submit'
                    ))?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>