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
                    <h4>3. BUSINESS ACTIVITY</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm text-center">
                                <!--                                                    TODO: To set showing of Capitalization / Gross for renewal-->
                                <thead>
                                <tr>
                                    <th rowspan="2">Line of Business</th>
                                    <th rowspan="2">No. of Units</th>
                                    <th rowspan="2">Capitalization</th>
                                    <th colspan="2">Gross/Sales/Receipts</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Essential</th>
                                    <th>Non-Essential</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Ayuda</td>
                                    <td>2</td>
                                    <td>500</td>
                                    <td>500</td>
                                    <td>500</td>
                                    <td>
                                        <?php echo form_button(array(
                                            'name'=>'delete',
                                            'value'=>'',
                                            'class'=>'btn btn-danger',
                                            'type'=>'submit'
                                        ),'<i class="fa fa-trash"></i>')?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
                                    <td style="padding: 0">
                                        <?php echo form_input(array(
                                            'placeholder'=>'click to input...',
                                            'style'=>'border: 0; width: 100%; height: 100%'
                                        ))?>
                                    </td>
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
        window.location.href = '<?php echo base_url(); ?>admin/step5';
    }

    open();
</script>