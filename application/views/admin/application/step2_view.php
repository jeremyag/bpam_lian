<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php echo form_open(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Application</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h5>INSTRUCTION:</h5>
                        <ol>
                            <li>Make sure to provide accurate information. An incomplete application form will not be saved to the database.</li>
                            <li>Ensure that the form are aligned to the document and all are complete and properly filled out.</li>
                        </ol>
                    </div>
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
                                    ))
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Date of Application</label>
                            <?php echo form_input(array(
                                'type'=>'date',
                                'value'=>date('Y-m-d'),
                                'class'=>'form-control',
                                'name'=>'form_date_application'
                            ))?>
                        </div>
                        <div class="col-md-6">
                            <label>DTI/SEC/CDA Registration No.:</label>
                            <?php echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_registration_no',
                            ))?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label>TIN No.:</label>
                            <?php echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_tin'
                            ))?>
                        </div>
                        <div class="col-md-6">
                            <label>DTI/SEC/CDA Date of Registration:</label>
                            <?php echo form_input(array(
                                'type'=>'date',
                                'class'=>'form-control',
                                'name'=>'form_registration_date',
                                'value'=>''
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
                                ))
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
                                ))
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
                                ))
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
                                ), 'no')
                            ?>
                            <br>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <label>Please specify the entity:</label>
                                    <?php
                                        echo form_input(array(
                                            'class'=>'form-control',
                                            'name'=>'form_tax_incentive'
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
                                    'name'=>'form_taxpayer_last_name'
                                ))
                            ?>
                        </div>
                        <div class="col-md-4">
                            <label>First Name:</label>
                            <?php echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_taxpayer_first_name'
                            ))?>
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name:</label>
                            <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_taxpayer_middle_name'
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
                                'name'=>'form_business_name'
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
                                    'name'=>'form_trade_name'
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
        window.location.href = '<?php echo base_url(); ?>admin/step2';
    }

    open();
</script>