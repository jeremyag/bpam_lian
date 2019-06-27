<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php echo form_open('Application_Controller/step5_submit'); ?>
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
                    <h4>3. BUSINESS ACTIVITY</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm text-center">
                                <thead>
                                <tr>
                                    <th rowspan="2">Line of Business</th>
                                    <th rowspan="2">No. of Units</th>
                                    <?php if($this->session->userdata('application_form')['application']['isNew']): ?>
                                    <th rowspan="2">Capitalization (for New Business)</th>
                                    <?php else:?>
                                    <th colspan="2">Gross/Sales/Receipts (For Renewal)</th>
                                    <?php endif;?>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <?php if(!$this->session->userdata('application_form')['application']['isNew']): ?>
                                    <th>Essential</th>
                                    <th>Non-Essential</th>
                                    <?php endif;?>
                                </tr>
                                </thead>
                            <?php $business_activities = (isset($this->session->userdata('application_form')['business_activities']) ? $this->session->userdata('application_form')['business_activities']: array());
                                if(count($business_activities)):
                            ?>
                               <?php foreach($business_activities as $index => $b):?>
                                <tr>
                                    <td><?=$b['line_of_business']?></td>
                                    <td><?=$b['no_of_units']?></td>
                                    <?php if($this->session->userdata('application_form')['application']['isNew']):?>
                                    <td><?=$b['capitalization']?></td>
                                    <?php endif;?>
                                    <?php if(!$this->session->userdata('application_form')['application']['isNew']): ?>
                                    <td><?=$b['essential_receipts']?></td>
                                    <td><?=$b['non_essential_receipts']?></td>
                                    <?php endif;?>
                                    <td>
                                        <?php echo form_button(array(
                                            'name'=>'delete',
                                            'value'=>$index,
                                            'class'=>'btn btn-danger',
                                            'type'=>'submit'
                                        ),'<i class="fa fa-trash"></i>')?>
                                    </td>
                                </tr>
                               <?php endforeach; ?>
                            <?php endif; ?>
                                <tr>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'name'=>'form_line_of_business',
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'name'=>'form_no_of_unit',
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <?php if($this->session->userdata('application_form')['application']['isNew']): ?>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'name'=>'form_capitalization',
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <?php endif;?>
                                    <?php if(!$this->session->userdata('application_form')['application']['isNew']): ?>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'name'=>'form_essential_receipts',
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'name'=>'form_non_essential_receipts',
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <?php endif;?>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <?php echo form_submit(array(
                                    'class'=>'btn btn-success',
                                    'value'=>'Add',
                                    'name'=>'add'
                                )) ?>
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
        window.location.href = '<?php echo base_url().add_index(); ?>admin/step5';
    }

    open();
</script>