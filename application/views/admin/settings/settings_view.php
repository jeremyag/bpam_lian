<div class="row">
    <div class="col-md-3">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <i class="fa fa-cog"></i> Settings
            </div>
            <ul class="list-group list-group-flush">
                <a id="assessment-fees" href="#assessment-fees" class="list-group-item list-group-item-action">
                    <i class="fa fa-money-bill text-success"></i> Assessment Fees
                </a>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <span id="setting-title">Settings</span>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                </div>
                <br>
                <div id="setting-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Local Taxes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gross Sales Tax</td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#actionModal" href="#"><i class="fa fa-pen"></i></a> 
                                    <a data-toggle="modal" data-target="#actionModal" href="#"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
        	...
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#assessment-fees").on("click", function(){
            // $(".progress").css("display", "block");

            // $("#other-information").addClass("active");
            // $("#business-activity").removeClass("active");

            // $.ajax({
            //     url: base_url,
            //     dataType: "html",
            //     type: "get",
            //     data: {
            //         business_id : business
            //     },
            //     success: function(html){
            //         $(".progress").css("display", "none");
            //         $("#information").empty();
            //         $("#information").append(html);
            //     }
            // });
        });
    });
</script>