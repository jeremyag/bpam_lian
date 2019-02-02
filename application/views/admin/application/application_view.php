<br>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <a href="<?php echo base_url();?>admin/step1" class="btn btn-danger btn-lg"><i class="fa fa-folder-plus"></i> New Application</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Applications</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>Application #</th>
                        <th>Type</th>
                        <th>Business Name</th>
                        <th>Date of Application</th>
                        <th>DTI/SEC/CDA Registration No.:</th>
                        <th>Owner</th>
                        <th>Is Verified?</th>
                        <th>Is Assessed?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-warning row-clickable" onclick="rowClick('#','','')">
                        <td>1</td>
                        <td>Renewal</td>
                        <td>Ayuda</td>
                        <td>2019-01-06</td>
                        <td>16-26971</td>
                        <td>Jeremy P. Agcaoili</td>
                        <td class="text-center"><i class="fa fa-check-circle text-success"></i> </td>
                        <td class="text-center"><i class="fa fa-times-circle text-danger"></i> </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>