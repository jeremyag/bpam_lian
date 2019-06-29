<div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle text-success"></i> Application Submitted! </h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        The Application has been submitted and is ready for verification! Do you want to proceed and verify the request?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="cancel" name="cancel" class="btn btn-secondary">Later
                    </button>
                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Yes <i class="fa fa-chevron-right"></i> </button>
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