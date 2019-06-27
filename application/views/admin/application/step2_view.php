<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php 
            //Set boolean if application already exist.
            $isSet = isset($application);
        ?>
        <?php echo form_open('Application_Controller/step2_submit'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$application->isNew ? "New Application" : "Renew Application" ?></h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h5>INSTRUCTION:</h5>
                        <ol>
                            <li>Make sure to provide accurate information. An incomplete application form will not be saved to the database.</li>
                            <li>Ensure that the form are aligned to the document and all are complete and properly filled out.</li>
                            <?php if(!$application->isNew): ?>
                                <li><b><u>FOR RENEWAL APPLICATIONS</u></b> any changes in certain information will reflect once submitted.</li>
                            <?php endif;?>
                        </ol>
                    </div>
                    <?php if($this->session->flashdata('step2_errors')):?>
                    <div class="alert alert-danger">
                        <h6>Form Errors:</h6>
                        <p><?=$this->session->flashdata('step2_errors')?></p>
                    </div>
                    <?php endif;?>
                    <h4>1. BASIC INFORMATION</h4>
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
                </div>
                <div class="modal-footer">
<!--                    CANCEL MODAL-->
                    <div class="modal fade" id="cancelModal" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cancel application</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <h1><i class="fa fa-question"></i></h1>
                                            </div>
                                            <div class="col-md-9">
                                                Are you sure you want to cancel this application?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="open_cancel()">No</button>
                                    <?php echo form_submit(array(
                                        'class'=>'btn btn-primary',
                                        'value'=>'Yes',
                                        'name'=>'cancel'
                                    ))?>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    END OF CANCEL MODAL-->
                    <br>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
                        Cancel
                    </button>
                    <?php echo form_submit(array(
                        'class'=>'btn btn-secondary',
                        'name'=>'back',
                        'value'=>'Back'
                    ))?>
                    <?php echo form_submit(array(
                        'class'=>'btn btn-primary',
                        'name'=>'submit',
                        'value'=>'Next'
                    ))?>
                    </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    function open() {
        $('#myModal').modal('show');
        $('#cancelModal').modal('hide');
    }

    function tax() {
        $('#collapseExample').collapse('toggle');
    }

    function open_cancel(){
        window.location.href = '<?php echo base_url().add_index(); ?>admin/step2';
    }

    open();
</script>