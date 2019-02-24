<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>admin/accounts"><i class="fa fa-users"></i> Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url();?>admin/profile"><i class="fa fa-user"></i> View Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Edit: <?=$profile->get_fullname()?></h2>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <a href="<?php echo base_url() ?>admin/profile" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <br>
                <?php echo form_open('Account_Controller/update'); ?>
                    <?=form_hidden('id',$profile->id)?>
                    <table class="table table-bordered">
                        <tr>
                            <th>First name:</th>
                            <td style="width: 75%"><?php echo form_input(array(
                                    'name'=>'form_first_name',
                                    'value'=>$profile->first_name,
                                    'class'=>'form-control'
                                ));?></td>
                        </tr>
                        <tr>
                            <th>Middle name:</th>
                            <td style="width: 75%"><?php echo form_input(array(
                                    'name'=>'form_middle_name',
                                    'value'=>$profile->middle_name,
                                    'class'=>'form-control'
                                ));?></td>
                        </tr>
                        <tr>
                            <th>Last name:</th>
                            <td style="width: 75%"><?php echo form_input(array(
                                    'name'=>'form_last_name',
                                    'value'=>$profile->last_name,
                                    'class'=>'form-control'
                                ))?></td>
                        </tr>
                        <tr>
                            <th>Username:</th>
                            <td style="width: 75%"><?=$profile->username?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td style="width: 75%"><?=form_password(array(
                                'name'=>'form_password',
                                'class'=>'form-control'
                            ))?><br><small>Note: Leave this field blank if you don't want to change the password.</small></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td style="width: 75%"><?php echo form_dropdown(array(
                                    'name'=>'form_position',
                                    'class'=>'form-control'
                                ), array(
                                    'Administrator'=>'Administrator',
                                    'Checker'=>'Checker',
                                    'Treasurer'=>'Treasurer'
                                ),$profile->position)?></td>
                        </tr>
                        <!-- <tr>
                            <th>Privilege:</th>
                            <td style="width: 75%">Full Privilege</td>
                        </tr> -->
                        <tr>
                            <th>Contact no:</th>
                            <td style="width: 75%"><?php echo form_input(array(
                                    'name'=>'form_contact_no',
                                    'value'=>$profile->contact_no,
                                    'class'=>'form-control'
                                ));?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td style="width: 75%"><?php echo form_input(array(
                                    'name'=>'form_email',
                                    'value'=>$profile->email,
                                    'type'=>'email',
                                    'class'=>'form-control'
                                ));?></td>
                        </tr>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Updating account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info">
                                        <div class="row">
                                           <div class="col-md-3 text-right">
                                               <h1><i class="fa fa-question"></i></h1>
                                           </div>
                                           <div class="col-md-9">
                                               Are you sure you want to update this profile?
                                           </div>
                                       </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <?php echo form_submit(array(
                                        'class'=>'btn btn-primary',
                                        'value'=>'Update',
                                        'name'=>'submit'
                                    ))?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Updating account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <h1><i class="fa fa-exclamation-triangle"></i></h1>
                                            </div>
                                            <div class="col-md-9">
                                                Are you sure you want to disable this account?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <?php echo form_submit(array(
                                        'class'=>'btn btn-danger',
                                        'value'=>'Disable Account',
                                        'name'=>'submit'
                                    ))?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <?php if($profile->isActive): ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#disableModal">
                            Disable Account
                        </button>
                        <?php else: ?>
                            <?php echo form_submit(array(
                                'class'=>'btn btn-success',
                                'value'=>'Activate',
                                'name'=>'submit'
                            ))?>
                        <?php endif;?>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
                            Update
                        </button>

                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>