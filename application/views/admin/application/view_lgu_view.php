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
                <!-- <a href="#" class="btn btn-secondary"><i class="fa fa-download"></i> CSV</a> -->
                <a href="<?=base_url().add_index()?>Application_Controller/print?id=<?=$application->id?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
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
                <br><br><br>
                <h5>ASSESSMENT OF APPLICABLE FEES</h5>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Local Taxes</th>
                            <th class="text-center">Amount Due</th>
                            <th class="text-center">Penalty/Subcharge</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0;?>
                        <?php if($status->isAssessed):?>
                        <?php $assessments = $application->get_assessments(); ?>
                        <?php if(count($assessments)):?>
                        <?php foreach($assessments as $a):?>
                        <tr>
                            <td class="text-center"><?=$a->local_taxes?></td>
                            <td class="text-center"><?=number_format($a->amount_due, 2)?></td>
                            <td class="text-center"><?=number_format($a->penalty_subcharge, 2)?></td>
                            <td class="text-center"><?=number_format($a->get_total(), 2)?></td>
                            <?php $total += $a->get_total() ?>
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                        <?php else:?>
                            <td colspan="4" class="text-center"><b>Not Assessed yet by Treasurer</b></td>
                        <?php endif;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="3">TOTAL FEES for LGU: </th>
                            <th class="text-center"><?= $total ?></th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="3">FIRE SAFETY INSPECTION FEE (10%): </th>
                            <th class="text-center"><?= number_format($total * .10, 2) ?></th>
                        </tr>
                    </tfoot>
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