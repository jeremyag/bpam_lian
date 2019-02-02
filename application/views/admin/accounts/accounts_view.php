<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url()?>admin/accounts"><i class="fa fa-users"></i> Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>admin/profile"><i class="fa fa-user"></i> My Profile</a>
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
                    <td>1</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-primary">
            <table style="width: 100%">
                <tr>
                    <th><i class="fa fa-user-check"></i> Checkers</th>
                    <td>1</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">
            <table style="width: 100%">
                <tr>
                    <th><i class="fa fa-money-bill-wave"></i> Treasurer</th>
                    <td>1</td>
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
                    <a href="<?php echo base_url();?>admin/register" class="btn btn-danger"><i class="fa fa-user-plus"></i> New Account</a>
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="row-clickable" onclick="rowClick('profile.php','id','1')">
                        <td>16-26971</td>
                        <td>Jeremy</td>
                        <td>Pasiona</td>
                        <td>Agcaoili</td>
                        <td>Checker</td>
                        <td><i class="fa fa-chevron-right"></i> </td>
                    </tr><tr class="row-clickable" onclick="rowClick('profile.php','id','2')">
                        <td>16-26977</td>
                        <td>John</td>
                        <td>De la Cruz</td>
                        <td>Doe</td>
                        <td>Treasurer</td>
                        <td><i class="fa fa-chevron-right"></i> </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>