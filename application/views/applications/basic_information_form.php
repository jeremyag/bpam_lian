<?php 
    $isSet = isset($application);
    if($isSet){
        $business = $application->get_business();
        $owner = $business->get_owner();
    }
?>
<h4>1. BASIC INFORMATION</h4>
<input type="hidden" name="application_id" value="<?=$application->id?>"/>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-form-label">Mode of Payment:</label>
            <?php
                echo form_dropdown(array(
                    'class'=>'form-control',
                    'name'=>'form_mode_of_payment'
                ),array(
                    'Annually'=>'Annually',
                    'Semi-Annually'=>'Semi-Annually',
                    'Quarterly'=>'Quarterly'
                ),($isSet ? $business->mode_of_payment : ''))
            ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label>Date of Application</label>
        <?php echo form_input(array(
            'type'=>'date',
            'value'=>($isSet ? $application->date_of_application : date('Y-m-d')),
            'class'=>'form-control',
            'name'=>'form_date_application'
        ))?>
    </div>
    <div class="col-md-6">
        <label>DTI/SEC/CDA Registration No.:</label>
        <?php echo form_input(array(
            'class'=>'form-control',
            'name'=>'form_dti_registration_no',
            'value'=>($isSet ? $business->dti_reg_no : '')
        ))?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <label>TIN No.:</label>
        <?php echo form_input(array(
            'class'=>'form-control',
            'name'=>'form_tin',
            'value'=>($isSet ? $owner->tin : '')
        ))?>
    </div>
    <div class="col-md-6">
        <label>DTI/SEC/CDA Date of Registration:</label>
        <?php echo form_input(array(
            'type'=>'date',
            'class'=>'form-control',
            'name'=>'form_dti_registration_date',
            'value'=>($isSet ? $business->dti_reg_date : '')
        ))?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <label>Type of Business:</label>
        <?php
            echo form_dropdown(array(
                'class'=>'form-control',
                'name'=>'form_type_of_business',
            ), array(
                'Single'=>'Single',
                'Partnership'=>'Partnership',
                'Corporation'=>'Corporation',
                'Cooperative'=>'Cooperative'
            ),($isSet ? $business->type : ''))
        ?>
    </div>
</div>
<br>
<label>Amendment</label>
<div class="row">
    <div class="col-md-6">
        <label>From:</label>
        <?php
            echo form_dropdown(array(
                'class'=>'form-control',
                'name'=>'form_amendment_from'
            ), array(
                'Single'=>'Single',
                'Partnership'=>'Partnership',
                'Corporation'=>'Corporation'
            ), ($isSet ? $application->amendment_from : ""))
        ?>
    </div>
    <div class="col-md-6">
        <label>To:</label>
        <?php
            echo form_dropdown(array(
                'class'=>'form-control',
                'name'=>'form_amendment_to'
            ), array(
                'Single'=>'Single',
                'Partnership'=>'Partnership',
                'Corporation'=>'Corporation'
            ), ($isSet ? $application->amendment_to : ""))
        ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <label>Are you enjoying tax incentive from any Government entity?</label>
        <?php
            echo form_dropdown(array(
                'class'=>'form-control',
                'onchange'=>'tax()'
            ),array(
                'yes'=>'Yes',
                'no'=>'No'
            ),'no')
        ?>
        <br>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <label>Please specify the entity:</label>
                <?php
                    echo form_input(array(
                        'class'=>'form-control',
                        'name'=>'form_tax_incentives',
                        'value'=>($isSet ? $business->tax_incentives : '')
                    ))
                ?>
            </div>
        </div>
    </div>
</div>
<hr>
<h5>Name of Taxpayer/Registrant</h5>
<div class="row">
    <div class="col-md-4">
        <label>Last Name:</label>
        <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_taxpayer_last_name',
                'value'=>($isSet ? $owner->last_name : '')
            ))
        ?>
    </div>
    <div class="col-md-4">
        <label>First Name:</label>
        <?php echo form_input(array(
            'class'=>'form-control',
            'name'=>'form_taxpayer_first_name',
            'value'=>($isSet ? $owner->first_name : '')
        ))?>
    </div>
    <div class="col-md-4">
        <label>Middle Name:</label>
        <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_taxpayer_middle_name',
                'value'=>($isSet ? $owner->middle_name : '')
            ))
        ?>
    </div>
</div>
<br>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Business Name:</label>
        <?php echo form_input(array(
            'class'=>'form-control',
            'name'=>'form_business_name',
            'value'=>($isSet ? $business->business_name : '')
        ))?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <label>Trade name / Franchise:</label>
        <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_trade_name',
                'value'=>($isSet ? $business->trade_name : '')
            ))
        ?>
    </div>
</div>