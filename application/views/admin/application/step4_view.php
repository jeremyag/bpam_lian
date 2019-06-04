<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php $isset = isset($business_details); ?>
        <?=form_open('Application_Controller/step4_submit')?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Application</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h5>INSTRUCTION:</h5>
                        <ol>
                            <li>Make sure to provide accurate information. An incomplete application form will not be saved to the database.</li>
                            <li>Ensure that the form are aligned to the document and all are complete and properly filled out.</li>
                        </ol>
                    </div>
                    <?php if($this->session->flashdata('step4_errors')): ?>
                        <div class="alert alert-danger">
                            <h6>Form errors:</h6>
                            <?=$this->session->flashdata('step4_errors')?>
                        </div>
                    <?php endif;?>
                    <h4>2. OTHER INFORMATION</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Business Area (in sq. m.)</label>
                            <?php
                                echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_business_area',
                                    'value'=>($isset ? $business_details->business_area : '')
                                ))
                            ?>
                        </div>
                        <div class="col-md-4">
                            <label>Total No. of Employees in Establishment</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_employee_no',
                                'type'=>'number',
                                'value'=>($isset ? $business_details->total_no_employees : '')
                            ))
                            ?>
                        </div>
                        <div class="col-md-4">
                            <label>No. of Employees Residing within LGU:</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_employee_lgu',
                                'type'=>'number',
                                'value'=>($isset ? $business_details->no_lgu_residing : '')
                            ))
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Is Business Place Rented?</label>
                            <?php
                                echo form_dropdown(array(
                                    'class'=>'form-control',
                                    'onchange'=>'rented()',
                                    'name'=>'isRented'
                                ), array(
                                    'no'=>'No',
                                    'yes'=>'Yes'
                                ))
                            ?>
                            <br>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Lessor's Full Name:</label>
                                            <?php
                                            echo form_input(array(
                                                'class'=>'form-control',
                                                'name'=>'form_lessor_name',
                                                'value'=>($isset ? $lessor->full_name : '')
                                            ))
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Lessor's Full Address:</label>
                                            <?php
                                            echo form_textarea(array(
                                                'class'=>'form-control',
                                                'name'=>'form_lessor_address',
                                                'rows'=>'2',
                                                'value'=>($isset ? $lessor->full_address : '')
                                            ))
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Lessor's Full Telephone/Mobile No.:</label>
                                            <?php
                                            echo form_input(array(
                                                'class'=>'form-control',
                                                'name'=>'form_lessor_contact',
                                                'value'=>($isset ? $lessor->contact : '')
                                            ))
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Lessor's Email Address:</label>
                                            <?php
                                            echo form_input(array(
                                                'class'=>'form-control',
                                                'name'=>'form_lessor_email',
                                                'type'=>'email',
                                                'value'=>($isset ? $lessor->email : '')
                                            ))
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Monthly Rental:</label>
                                            <?php
                                            echo form_input(array(
                                                'class'=>'form-control',
                                                'name'=>'form_lessor_rental',
                                                'value'=>($isset ? $lessor_details->monthly_rental : '')
                                            ))
                                            ?>
                                        </div>
                                    </div>
                                </div>
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
        <?=form_close()?>
    </div>
</div>

<script>
    function open() {
        $('#myModal').modal('show');
    }

    function rented() {
        $('#collapseExample').collapse('toggle');
    }

    function open_cancel(){
        window.location.href = '<?php echo base_url().add_index(); ?>admin/step4';
    }

    open();
</script>