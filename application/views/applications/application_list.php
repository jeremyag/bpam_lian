<div class="row">
    <div class="col-md-6">
        <table class="table-bordered">
            <tr>
                <?php if(!is_treasurer()):?>
                <th data-status="all" class="table-status-filter table-info table-card-filter table-filter-btn">All</th>
                <th data-status="unverified" class="table-status-filter table-danger table-card-filter table-filter-btn">Unverified</th>
                <th data-status="missing_docs" class="table-status-filter table-warning table-card-filter table-filter-btn">Missing Docs</th>
                <?php endif;?>
                <th data-status="assessment" class="table-status-filter table-success table-card-filter table-filter-btn">On Assessment</th>
                <th data-status="done" class="table-status-filter table-primary table-card-filter table-filter-btn">Done</th>
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
        <th data-sort="a.id" class="table-sorter table-filter-btn"><span></span><br>Application #</th>
        <th>Type</th>
        <th data-sort="b.business_name" class="table-sorter table-filter-btn"><span></span><br>Business Name</th>
        <th data-sort="a.date_of_application" class="table-sorter table-filter-btn"><span></span><br>Date of Application</th>
        <th data-sort="b.dti_reg_no" class="table-sorter table-filter-btn"><span></span><br>DTI/SEC/CDA Registration No.:</th>
        <th>Owner</th>
        <th>Is Verified?</th>
        <th>Is Assessed?</th>
    </tr>
    </thead>
    <tbody id="rows">
    </tbody>
    <tfoot id="loading2">
        <tr>
            <td colspan="8" class="text-center"><img src="<?=base_url()?>assets/img/loading.gif"></td>
        </tr>
    </tfoot>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if($total>0):?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for($i = 1; $i <= $total; $i++):?>
            <li class="page-item <?=($current_page == $i ? "active" : "")?>"><a class="page-link" href="#"><?=$i?></a></li>
        <?php endfor;?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <?php endif;?>
    </ul>
</nav>
<script>
    $(function(){
        let _status = '<?=is_treasurer() ? "assessment" : "all"?>';
        $("tbody#rows").empty();
        $("#loading2").css("display", "block");
        
        $.ajax({
            url: "<?=base_url().add_index()?>Application_Controller/application_rows",
            dataType: "html",
            type: "get",
            data: {
                    show:1,
                    sort_field: "a.id",
                    sort_sort: "DESC",
                    sort_status: _status
            },
            success: function(html){
                $("#loading2").css("display", "none");
                $("tbody#rows").append(html);
            }
        });

        let sort = {
            field: "a.id",
            sort: "DESC",
            status: "all"
        };

        let activate_sort = function(sort, field){
            let asc = "<i class='text-success fa fa-sort-amount-up fa-xs'></i>";
            let desc = "<i class='text-danger fa fa-sort-amount-down fa-xs'></i>";
            $(".table-sorter").removeClass("table-filter-active");
            $(".table-sorter > span").empty();
            
            if(sort.field == field){
                if(sort.sort == "ASC"){
                    $("[data-sort='"+field+"']").addClass("table-filter-active");
                    sort.sort = "DESC";
                    $("[data-sort='"+field+"'] > span").append(desc);
                }
                else{
                    sort.sort = "none"; $("[data-sort='"+field+"']").addClass("table-filter-active");
                    sort.sort = "ASC";
                    $("[data-sort='"+field+"'] > span").append(asc);
                }
            }
            else{
                $("[data-sort='"+field+"']").addClass("table-filter-active");
                sort.sort = "asc";
                sort.field = field;
                $("[data-sort='"+field+"'] > span").append(asc);
            }
            return sort;
        };

        $(".table-sorter").on("click", function(){
            activate_sort(sort, $(this).data("sort"));

            $("tbody#rows").empty();
            $("#loading2").css("display", "block");

            $.ajax({
                url: "<?=base_url().add_index()?>Application_Controller/application_rows",
                dataType: "html",
                type: "get",
                data: {
                    show:1,
                    sort_field: sort.field,
                    sort_sort: sort.sort,
                    sort_status: sort.status
                },
                success: function(html){
                    $("#loading2").css("display", "none");
                    $("tbody#rows").append(html);
                }
            });
        });

        $(".table-status-filter").on("click", function(){
            $(".table-status-filter").removeClass("table-filter-active");
            $(this).addClass("table-filter-active");

            let filter = $(this).data("status");
            sort.status = filter;

            $("tbody#rows").empty();
            $("#loading2").css("display", "block");

            $.ajax({
                url: "<?=base_url().add_index()?>Application_Controller/application_rows",
                dataType: "html",
                type: "get",
                data: {
                    show:1,
                    sort_field: sort.field,
                    sort_sort: sort.sort,
                    sort_status: sort.status
                },
                success: function(html){
                    $("#loading2").css("display", "none");
                    $("tbody#rows").append(html);
                }
            });
        });
    });
</script>