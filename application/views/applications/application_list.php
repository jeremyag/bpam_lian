<div class="row">
    <div class="col-md-6">
        <table class="table-bordered">
            <tr>
                <th class="table-info table-card-filter table-filter-btn">All</th>
                <th class="table-danger table-card-filter table-filter-btn">Unverified</th>
                <th class="table-warning table-card-filter table-filter-btn">On Assessment</th>
                <th class="table-success table-card-filter table-filter-btn">Done</th>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Quick search" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
            <div class="input-group-append" id="button-addon4">
                <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="text-right">
            <a data-toggle="collapse" href="#more-filters" role="button" aria-expanded="false" aria-controls="more-filters">
                More filters
            </a>
        </div>
    </div>
</div>
<br>
<div class="collapse" id="more-filters">
    <div class="card card-body">
        <table>
            <tr>
                <th>Application #:</th>
                <td colspan="2"><input type="text" class="form-control"></td>
            </tr>
            <tr>
                <th>Type:</th>
                <td colspan="2">
                    <select class="form-control">
                        <option>New</option>
                        <option>Renewal</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Business Name:</th>
                <td colspan="2"><input type="text" class="form-control"></td>
            </tr>
            <tr>
                <th>Date of Application:</th>
                <td>From: <br><input type="date" class="form-control"></td>
                <td>To: <br><input type="date" class="form-control"></td>
            </tr>
            <tr>
                <th>DTI/SEC/CDA Registration No.:</th>
                <td colspan="2"><input type="text" class="form-control"></td>
            </tr>
            <tr>
                <th>Owner:</th>
                <td><input type="text" class="form-control" placeholder="First name"></td>
                <td><input type="text" class="form-control" placeholder="Last name"></td>
            </tr>
        </table>
        <br>
        <div class="text-right">
            <button class="btn btn-secondary">Filter</button><br>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-10 text-right">Show per page: </div>
    <div class="col-md-2">
        <select class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="20">20</option>
            <option value="40">40</option>
            <option value="100">100</option>
            <option value="1000">1000</option>
        </select>
    </div>
</div>
<br>
<table class="table table-hover table-bordered table-sm">
    <thead>
    <tr>
        <th class="table-filter-btn"><i class="text-success fa fa-sort-amount-up fa-xs"></i><br> Application #</th>
        <th class="table-filter-btn"><i class="text-danger fa fa-sort-amount-down fa-xs"></i><br>Type</th>
        <th class="table-filter-btn">Business Name</th>
        <th class="table-filter-btn">Date of Application</th>
        <th class="table-filter-btn">DTI/SEC/CDA Registration No.:</th>
        <th class="table-filter-btn">Owner</th>
        <th class="table-filter-btn">Is Verified?</th>
        <th class="table-filter-btn">Is Assessed?</th>
    </tr>
    </thead>
    <tbody id="rows">
    </tbody>
    <tfoot>
        <tr id="loading2">
            <td colspan="8" class="text-center"><img src="<?=base_url().add_index()?>assets/img/loading.gif"></td>
        </tr>
    </tfoot>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>
<script>
    $(function(){
        $("tbody#rows").empty();
        $("#loading2").css("display", "block");
        
        $.ajax({
            url: "<?=base_url().add_index()?>Application_Controller/application_rows",
            dataType: "html",
            type: "get",
            data: {
                show:1
            },
            success: function(html){
                $("#loading2").css("display", "none");
                $("tbody#rows").append(html);
            }
        });
    });
</script>