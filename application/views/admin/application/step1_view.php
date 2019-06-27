<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?php echo form_open(); ?>
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
                                <label for="message-text" class="col-form-label">Current License No.:</label>
                                <div style="position: sticky;">
                                    <?php echo form_input(array(
                                        'class'=>'form-control border-danger',
                                        'name'=>'form_registration_no',
                                        'id'=>'registration_no',
                                        'autocomplete'=>'off'
                                    ))?>
                                    <span style="position: absolute; right: 15px; top: 12px;">
                                        <i id="ok" class="fa fa-check-circle text-success" style="display: none"></i>
                                        <i id="wrong" class="fa fa-times-circle text-danger"></i>
                                        <img id="loading" src="<?=base_url().add_index()?>assets/img/loading.gif" style="width: 18px; display:none;">
                                    </span>
                                </div>
                                <input type="hidden" id="business_id" name="business_id">
                                <div id="auto-search">
                                
                                </div>
                                <div id="message" style="margin-top: 25px">
                                    
                                </div>
                                <script>
                                    $("#registration_no").on("keyup", function(e){
                                        $("#message").empty();
                                        $("#business_id").val("");
                                        $("#registration_no").addClass("border-danger");
                                        $("#registration_no").removeClass("border-success");
                                        $("#loading").css("display", "block");
                                        $("#wrong").css("display", "none");
                                        $("#ok").css("display", "none");

                                        let _keyword = $(this).val();
                                        if(_keyword === ""){
                                            $("#auto-search").empty();
                                        }
                                        else{
                                            $.ajax({
                                                url: "<?=base_url().add_index()?>Application_Controller/auto_license_search",
                                                dataType: "html",
                                                type: "get",
                                                data: {
                                                    keyword: _keyword
                                                },
                                                success: function(html){
                                                    $("#auto-search").empty();
                                                    $("#auto-search").append(html);
                                                }
                                            });
                                        }
                                    });
                                </script>
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
        $("#registration_no").val("");
        $("#license_no").val("");
    }

    open();
</script>