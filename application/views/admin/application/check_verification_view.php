<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <?php if($this->session->flashdata('not_accomplished')):?>
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-times-circle text-danger"></i> Application Not Verified!</h5>
                    <?php else: ?>
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle text-success"></i> Application Verified!</h5>
                    <?php endif; ?>
                </div>
                <div class="modal-body">
                <?php
                    $not_accomplished = $this->session->flashdata('not_accomplished');
                ?>

                    <?php if($this->session->flashdata('not_accomplished')):?>
                    <div class="alert alert-warning">
                        The application is marked as <b>NOT VERIFIED</b> for assessment. Some missing documents are required:
                        <br>
                        <ol>
                            <?php foreach($this->session->flashdata('not_accomplished') as $n): ?>
                            <li><b><?=$n['desc']?></b> from <?=$n['office']?></li>
                            <?php endforeach;?>
                        </ol>
                        The application has now stored temporarily to Unverified Applications with missing documents.
                    </div>
                    <?php else: ?>
                    <div class="alert alert-success">
                        The application is marked as <b>VERIFIED</b> and is ready for assessment. The request for assessment of application fees are now sent to the treasurer.
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function open() {
        $('#myModal').modal('show');
    }

    open();
</script>