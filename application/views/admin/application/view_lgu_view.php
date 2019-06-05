<?php 
    $business = $application->get_business(); 
    $owner = $business->get_owner();
?>
<style>
    .value{
        padding-left: 15px;
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-md-11">
        <div class="row">
            <div class="col-md-6">
                <a href="<?=base_url().add_index()?>admin/applications" class="btn"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="#" class="btn btn-secondary"><i class="fa fa-download"></i> CSV</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <br>
        <?php $status = $application->get_status(); ?>
        <?php if($status->isVerified == 0):?>
        <div class="alert alert-danger">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Status:</b> This application hasn't been verified.</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?=base_url().add_index()?>admin/verification?id=<?=$application->id?>" class="btn btn-success"><i class="fa fa-check-circle"></i> Verify</a>
                </div>
            </div>
        </div>
        <?php elseif($status->verifyAgain == 1):?>
        <div class="alert alert-danger">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Status:</b> This application has been marked as <b>Unverified</b>. It's still missing some documents.</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?=base_url().add_index()?>admin/verification?id=<?=$application->id?>" class="btn btn-success"><i class="fa fa-check-circle"></i> Verify Again</a>
                </div>
            </div>
        </div>
        <?php elseif($status->isAssessed == 0):?>
        <div class="alert alert-warning">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Status:</b> This application hasn't been assessed by the treasurer.</p>
                </div>
                <!-- <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-success"><i class="fa fa-check-circle"></i> Assess</a>
                </div> -->
            </div>
        </div>
        <?php endif;?>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().add_index()?>admin/view_application?id=<?=$application->id?>">Applicant Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=base_url().add_index()?>admin/view_application?id=<?=$application->id?>&section=2">LGU Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().add_index()?>admin/view_application?id=<?=$application->id?>&section=3">City / Municipality Section</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <?php if($status->isVerified):?>
                <div style="text-align: right">
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-secondary">Edit</button>
                </div>
                <h2 style="text-align: center">Application #<?=$application->id?></h2>
                <br>
                <h5>VERIFICATION OF DOCUMENTS</h5>
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Description</th>
                            <th class="text-center">Office/Agency</th>
                            <th class="text-center">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $verifications = $application->get_verifications(); ?>
                        <?php if(count($verifications)):?>
                        <?php foreach($verifications as $v):?>
                        <tr class="<?=($v->remarks == "No" ? "table-danger" : "")?>">
                            <td class="text-center"><?=$v->description?></td>
                            <td class="text-center"><?=$v->office_agency?></td>
                            <td class="text-center"><?=$v->remarks?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
                <?php else:?>
                    <div class="alert alert-danger"><b>Alert:</b> This application hasn't been verified!</div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<script>
    let base_url = '<?=base_url().add_index();?>Application_Controller/view_other_information';
    let business = <?=$business->id?>;
    let application = <?=$application->id?>;
</script>
<script src="<?php echo base_url();?>assets/js/applications/view_applications.js"></script>