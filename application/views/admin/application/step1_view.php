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
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Type of Application:</label>
                        <?php echo form_dropdown(array(
                            'class'=>'form-control',
                            'onchange'=>'renewal()',
                            'name'=>'form_type_application'
                        ),array(
                            '1'=>'New',
                            '2'=>'Renewal'
                        ),
                            'New') ?>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">DTI/SEC/CDA Registration No.::</label>
                                <?php echo form_input(array(
                                    'class'=>'form-control',
                                    'name'=>'form_registration_no'
                                ))?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo form_submit(array(
                        'class'=>'btn btn-secondary',
                        'name'=>'cancel',
                        'value'=>'Cancel'
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

    function renewal(){
        $('#collapseExample').collapse('toggle');
    }

    open();
</script>