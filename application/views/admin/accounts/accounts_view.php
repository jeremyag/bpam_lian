<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url().add_index()?>admin/accounts"><i class="fa fa-users"></i> Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url().add_index()?>admin/profile"><i class="fa fa-user"></i> View Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="alert alert-danger">
            <table style="width: 100%">
                <tr>
                    <th><i class="fa fa-user"></i> Administrators</th>
                    <td><?=$statistics->administrator?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-primary">
            <table style="width: 100%">
                <tr>
                    <th><i class="fa fa-user-check"></i> Checkers</th>
                    <td><?=$statistics->checkers?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">
            <table style="width: 100%">
                <tr>
                    <th><i class="fa fa-money-bill-wave"></i> Treasurer</th>
                    <td><?=$statistics->treasurer?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Accounts</h2>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="<?php echo base_url().add_index();?>admin/register" class="btn btn-danger"><i class="fa fa-user-plus"></i> New Account</a>
                </div>
                <br>
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>
                            First Name
                        </th>
                        <th>
                            Middle Name
                        </th>
                        <th>
                            Last Name
                        </th>
                        <th>
                            Position
                        </th>
                        <th>
                            Status
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(count($users)>0):
                            foreach($users as $user):
                    ?>

                    <tr class="row-clickable <?=($user->isActive ? "" : "table-danger")?>" onclick="rowClick('profile','id','<?=$user->id?>')">
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->middle_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td><?php echo $user->position; ?></td>
                        <td><?php echo ($user->isActive ? "Active <i class='text-success fa fa-check-circle'></i>" : "Disabled <i class='text-danger fa fa-times-circle'></i>"); ?></td>
                        <td><i class="fa fa-chevron-right"></i> </td>
                    </tr>

                    <?php  
                            endforeach;
                        endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>