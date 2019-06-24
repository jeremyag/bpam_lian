<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Businesses</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Business Name</th>
                            <th>Category</th>
                            <th>Owner</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($businesses)): ?>
                        <?php foreach($businesses as $b):?>
                        <tr>
                            <td><?=$b->id?></td>
                            <td><?=$b->business_name?></td>
                            <td><?=$b->category?></td>
                            <td><?=$b->get_owner()->get_full_name()?></td>
                            <td><?=$b->get_business_address()->get_full_address()?></td>
                            <td class="text-center">
                                <a href="<?=base_url().add_index()?>_business?id=<?=$b->id?>"><i class="fa fa-book-open"></i></a>
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
