<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <?=form_open('Application_Controller/verify')?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">II. LGU SECTION</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5>DESCRIPTION:</h5>
                        <p>This is the Part II of Application Form for Business Permit.</p>
                    </div>
                    <h4>1. Verification of Documents</h4>
                    <br>
                    <div class="card">
                        <div class="card-header text-right">
                            <a href="<?=base_url()?>admin/view_application?id=<?=$application->id?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> View application form (Opens in new Tab)</a>
                        </div>
                        <div class="card-body">
                            <h5>Verification for: Application form #<?=$application->id?>: <?=$application->get_business()->business_name?></h5>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>Description</th>
                            <th>Office/Agency</th>
                            <th>Yes</th>
                            <th>No</th>
                            <th>Not Needed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($verify_again)):?>
                            <?php if(count($verify_again)):?>
                                <?php $i = 0?>
                                <?php foreach($verify_again as $v):?>
                                <tr>
                                    <td><?=$v->description?></td>
                                    <td><?=$v->office_agency?></td>
                                    <input type="hidden" name="verification[<?=$i?>][id]" value="<?=$v->id?>">
                                    <input type="hidden" name="verification[<?=$i?>][application]" value="<?=$v->application_id?>">
                                    <input type="hidden" name="verification[<?=$i?>][desc]" value="<?=$v->description?>">
                                    <input type="hidden" name="verification[<?=$i?>][office]" value="<?=$v->office_agency?>">
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input  <?=($v->remarks == "Yes" ? "checked": "") ?> required type="radio" id="yes-<?=$i?>" name="verification[<?=$i?>][remarks]" value="Yes" class="custom-control-input">
                                            <label class="custom-control-label" for="yes-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input  <?=($v->remarks == "No" ? "checked": "") ?> required type="radio" id="no-<?=$i?>" name="verification[<?=$i?>][remarks]" value="No" class="custom-control-input">
                                            <label class="custom-control-label" for="no-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input  <?=($v->remarks == "Not Needed" ? "checked": "") ?> required type="radio" id="not-<?=$i?>" name="verification[<?=$i?>][remarks]" value="Not Needed" class="custom-control-input">
                                            <label class="custom-control-label" for="not-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        <?php else:?>
                            <?php if(count($verification_documents)):?>
                                <?php $i = 0; ?>
                                <?php foreach($verification_documents as $v):?>
                                <tr>
                                    <td><?=$v->description?></td>
                                    <td><?=$v->office_agency?></td>
                                    <input type="hidden" name="verification[<?=$i?>][id]" value="">
                                    <input type="hidden" name="verification[<?=$i?>][application]" value="<?=$application->id?>">
                                    <input type="hidden" name="verification[<?=$i?>][desc]" value="<?=$v->description?>">
                                    <input type="hidden" name="verification[<?=$i?>][office]" value="<?=$v->office_agency?>">
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input required type="radio" id="yes-<?=$i?>" name="verification[<?=$i?>][remarks]" value="Yes" class="custom-control-input">
                                            <label class="custom-control-label" for="yes-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input required type="radio" id="no-<?=$i?>" name="verification[<?=$i?>][remarks]" value="No" class="custom-control-input">
                                            <label class="custom-control-label" for="no-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-radio">
                                            <input required type="radio" id="not-<?=$i?>" name="verification[<?=$i?>][remarks]" value="Not Needed" class="custom-control-input">
                                            <label class="custom-control-label" for="not-<?=$i?>"></label>
                                        </div>
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="<?=base_url()?>admin/view_application?id=<?=$application->id?>" class="btn btn-secondary">Cancel
                    </a>
                    <button type="submit" value="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Verify</button>
                </div>
            </div>
        <?=form_close()?>
    </div>
</div>

<script>
    function open() {
        $('#myModal').modal('show');
    }

    open();
</script>