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
                        <h2><?=$profile->get_fullname()?></h2>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <a href="<?php echo base_url() ?>admin/profile?<?php echo ($this->input->get('id') ? "id=".$profile->id."&" : "") ?>edit=true" class="btn btn-danger"><i class="fa fa-pencil-alt"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>First name:</th>
                        <td style="width: 75%"><?=$profile->first_name?></td>
                    </tr>
                    <tr>
                        <th>Middle name:</th>
                        <td style="width: 75%"><?=$profile->middle_name?></td>
                    </tr>
                    <tr>
                        <th>Last name:</th>
                        <td style="width: 75%"><?=$profile->last_name?></td>
                    </tr>
                    <tr>
                        <th>Username:</th>
                        <td style="width: 75%"><?=$profile->username?></td>
                    </tr>
                    <tr>
                        <th>Position:</th>
                        <td style="width: 75%"><?=$profile->position?></td>
                    </tr>
                    <!-- <tr>
                        <th>Privilege:</th>
                        <td style="width: 75%">Full Privilege</td>
                    </tr> -->
                    <tr>
                        <th>Contact no:</th>
                        <td style="width: 75%"><?=$profile->contact_no?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td style="width: 75%"><?=$profile->email?></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td style="width: 75%;"><?=($profile->isActive ? "Active" : "Disabled")?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>