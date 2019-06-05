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
                <a href="<?=base_url().add_index()?>treasurer/assessments" class="btn"><i class="fa fa-chevron-left"></i> Back</a>
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
            </div>
        </div>
        <?php elseif($status->verifyAgain == 1):?>
        <div class="alert alert-danger">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Status:</b> This application has been marked as <b>Unverified</b>. It's still missing some documents.</p>
                </div>
            </div>
        </div>
        <?php elseif($status->isAssessed == 0):?>
        <div class="alert alert-warning">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Status:</b> This application hasn't been assessed by the treasurer.</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-success gModal-btn" data-application="3" data-base_url="http://localhost/BPAM_Lian/" data-gaction="assess"><i class="fa fa-check-circle"></i> Assess</a>
                </div>
            </div>
        </div>
        <?php endif;?>

        <?php if($application->is_done()):?>
        <div class="alert alert-success">
            <p><b>Status:</b> This application is successfully assessed.</p>
        </div>
        <?php endif;?>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().add_index()?>treasurer/view_application?id=<?=$application->id?>">Applicant Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().add_index()?>treasurer/view_application?id=<?=$application->id?>&section=2">LGU Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=base_url().add_index()?>treasurer/view_application?id=<?=$application->id?>&section=3">City / Municipality Section</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <?php $this->load->view($section, array(
                    "status" =>$status
                ))?>
            </div>
        </div>
    </div>
</div>
<script>
    let base_url = '<?=base_url().add_index();?>Application_Controller/view_other_information';
    let business = <?=$business->id?>;
    let application = <?=$application->id?>;
</script>
<script src="<?php echo base_url().add_index();?>assets/js/applications/view_applications.js"></script>