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
                <a href="<?=base_url()?>admin/applications" class="btn"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="#" class="btn btn-secondary"><i class="fa fa-download"></i> CSV</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Applicant Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">LGU Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">City / Municipality Section</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div style="text-align: right">
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-secondary">Edit</button>
                </div>
                <h2 style="text-align: center">Application #<?=$application->id?></h2>
                <br>
                <h5>BASIC INFORMATION</h5>
                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="6" style="width: 50%">Type: <span class="value"><?=$application->get_date_of_application('Y-m-d')?></span></td>
                        <td colspan="6" style="width: 50%">Mode of Payment: <span class="value"><?=$business->mode_of_payment?></span></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="width: 50%">Date of Application: <span class="value"><?=$application->get_date_of_application('Y-m-d')?></span></td>
                        <td colspan="6" style="width: 50%">DTI/SEC/CDA Registration No.: <span class="value"><?=$business->dti_reg_no?></span></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="width: 50%">TIN No.: <span class="value"><?=$owner->tin?></span></td>
                        <td colspan="6" style="width: 50%">DTI/SEC/CDA Date of Registration: <span class="value"><?=$business->get_dti_reg_date()?></span></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="width: 50%">
                            Amendment From: <span class="value"><?=$application->amendment_from?></span>
                        </td>
                        <td colspan="6" style="width: 50%">
                            To: <span class="value"><?=$application->amendment_to?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" style="width: 100%;">Incentives From Government Entity: <span class="value"><?=($business->tax_incentives != "" ? $business->tax_incentives :"No" )?></span></td>
                    </tr>
                    <tr>
                        <td colspan="12" style="width: 100%; text-align: center;"><b>Name of Taxpayer / Registrant</b></td>
                    </tr>
                    <tr>
                        <td colspan="4">Last Name: <span class="value"><?=$owner->last_name?></span></td>
                        <td colspan="4">First Name: <span class="value"><?=$owner->first_name?></span></td>
                        <td colspan="4">Middle Name: <span class="value"><?=$owner->middle_name?></span></td>
                    </tr>
                    <tr>
                        <td colspan="12">Business Name: <span class="value"><?=$business->business_name?></span></td>
                    </tr>
                    <tr>
                        <td colspan="12">Trade Name / Franchise: <span class="value"><?=$business->trade_name?></span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="other-information" href="#other-information">Other Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="business-activity" href="#business-activity">Business Activity</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                </div>
                <div id="information"></div>
            </div>
        </div>
    </div>
</div>
<script>
    let base_url = '<?=base_url();?>Application_Controller/view_other_information';
    let business = <?=$business->id?>;
    let application = <?=$application->id?>;
</script>
<script src="<?php echo base_url();?>assets/js/applications/view_applications.js"></script>