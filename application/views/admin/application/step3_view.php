<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php echo form_open('Application_Controller/step3_submit'); ?>
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
                        Application:<br>
                    </div>
                    <h4>2. OTHER INFORMATION</h4>
                    <div class="card card-body">
                        <h5>Business Address:</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Street/Sitio:</label>
                                <?php echo form_textarea(array(
                                    'class'=>'form-control',
                                    'name'=>'form_business_sitio',
                                    'rows'=>'2'
                                ))?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Barangay:</label>
<!--                                TODO: Update Barangays-->
                                <?php echo form_dropdown(array(
                                    'class'=>'form-control',
                                    'name'=>'form_business_brgy'
                                ), array(
                                    'Brgy. 1'=>'Brgy 1'
                                ))?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Postal Code:</label>
                                <?php
                                    echo form_input(array(
                                        'class'=>'form-control',
                                        'name'=>'form_business_postal'
                                    ))
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label>Email Address:</label>
                                <?php echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_business_email',
                                    'type'=>'email'
                                ))?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-body">
                        <h5>Owner's Address:</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Street/Sitio:</label>
                                <?php echo form_textarea(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_sitio',
                                    'rows'=>'2'
                                ))?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Barangay:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_brgy'
                                ))
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Municipality/City:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_municipality'
                                ))
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Province:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_province'
                                ))
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Postal Code:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_postal'
                                ))
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label>Email Address:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_owner_email',
                                    'type'=>'email'
                                ))
                                ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-body">
                        <h5>In case of emergency:</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Name of Contact person:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_emergency_person'
                                ))
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Telephone/Mobile No.:</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_emergency_contact'
                                ))
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label>Email Address</label>
                                <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_emergency_email',
                                    'type'=>'email'
                                ))
                                ?>
                            </div>
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
    }

    function open_cancel(){
        window.location.href = '<?php echo base_url(); ?>admin/step3';
    }

    open();

</script>