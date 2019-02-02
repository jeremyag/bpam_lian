<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle text-success"></i> Application Verified!</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        The application has been <b>VERIFIED</b> and is ready for assessment. The request for assessment of application fees are now sent to the treasurer.
                    </div>

                    <div class="alert alert-warning">
                        The application has <b>NOT VERIFIED</b> for assessment. Some missing documents are required:
                        <br>
                        <ol>
                            <li>Barangay Clearance</li>
                        </ol>
                        The application has now stored temporarily to Unverified Applications with missing documents.
                    </div>
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