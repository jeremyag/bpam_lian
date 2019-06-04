<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Assessments</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>Application #</th>
                        <th>Type</th>
                        <th>Business Name</th>
                        <th>Date of Application</th>
                        <th>DTI/SEC/CDA Registration No.:</th>
                        <th>Owner</th>
                        <th>Is Verified?</th>
                        <th>Is Assessed?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($applications)):?>
                    <?php foreach($applications as $a):?>
                    <tr class="table-warning row-clickable" onclick="rowClick('view_application','id','<?=$a->id?>')">
                        <?php $b = $a->get_business(); ?>
                        <td><?=$a->id?></td>
                        <td><?=$a->get_type()?></td>
                        <td><?=$b->business_name?></td>
                        <td><?=$a->get_date_of_application()?></td>
                        <td><?=$b->dti_reg_no?></td>
                        <td><?=$b->get_owner()->get_full_name() ?></td>
                        <td class="text-center"><i class="fa fa-check-circle text-success"></i> </td>
                        <td class="text-center"><i class="fa fa-times-circle text-danger"></i> </td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>