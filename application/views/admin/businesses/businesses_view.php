<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Businesses</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-bordered">
                            <tr>
                                <?php $status = isset($_GET["status"]) ? $_GET["status"] : false;?>
                                <th data-status="all" class="table-status-filter <?=$status == "all" ? "": "table-info" ?> table-card-filter table-filter-btn">All</th>
                                <th data-status="active" class="table-status-filter <?=$status == "active" ? "": "table-success" ?> table-card-filter table-filter-btn">Active</th>
                                <th data-status="no-license" class="table-status-filter <?=$status == "no-license" ? "": "table-warning" ?> table-card-filter table-filter-btn">No License</th>
                                <th data-status="expired" class="table-status-filter <?=$status == "expired" ? "": "table-danger" ?> table-card-filter table-filter-btn">Expired License</th>
                                <th data-status="closed" class="table-status-filter <?=$status == "closed" ? "": "table-secondary" ?> table-card-filter table-filter-btn">Closed</th>
                            </tr>
                        </table>
                        <script>
                            $(function(){
                                $(".table-status-filter").on("click", function(){
                                    let link = window.location.origin + window.location.pathname + "?status=";

                                    let status = $(this).data("status");

                                    link += status;

                                    window.location.href = link;
                                });
                            });
                        </script>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input type="text" name="quick-search" class="form-control" placeholder="Quick search" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                                <div class="input-group-append" id="button-addon4">
                                    <button id="search" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="text-right">
                                <a data-toggle="collapse" href="#more-filters" role="button" aria-expanded="false" aria-controls="more-filters">
                                    More filters
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <form>
                    <div class="collapse" id="more-filters">
                        <div class="card card-body">
                            <table>
                                <tr>
                                    <th>Business #:</th>
                                    <td colspan="2"><input name="filter_business_no" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Business Name:</th>
                                    <td colspan="2"><input name="filter_business_name" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td colspan="2"><input name="filter_business_category" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Owner:</th>
                                    <td colspan="2"><input name="filter_owner" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Barangay:</th>
                                    <td colspan="2"><input name="adress" type="text" class="form-control"></td>
                                </tr>
                            </table>
                            <br>
                            <div class="text-right">
                                <button class="btn btn-secondary" id="filter-submit">Filter</button><br>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Business Name</th>
                            <th>Category</th>
                            <th>Owner</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($businesses)): ?>
                        <?php foreach($businesses as $b):?>
                        <tr class="row-clickable" onclick="rowClick('<?=base_url().add_index()?>_business','id','<?=$b->id?>')">
                            <td><?=$b->id?></td>
                            <td><?=$b->business_name?></td>
                            <td><?=$b->category?></td>
                            <td><?=$b->get_owner()->get_full_name()?></td>
                            <td><?=$b->get_business_address()->get_full_address()?></td>
                            <td>Active</td>
                            <td class="text-center">
                                <i class="fa fa-chevron-right"></i>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
