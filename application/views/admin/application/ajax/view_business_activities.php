<?php 
    $business_activities = $application->get_business_activities();
?>
<h5>Business Activities</h5>
<table class="table table-sm table-bordered table-hover">
    <?php if(count($business_activities)):?>
    <tr>
        <th class="text-center" rowspan="2">Line of Business</th>
        <th class="text-center" rowspan="2">No. of Units</th>
        <?php if($application->isNew):?>
        <th class="text-center" rowspan="2">Capitalizations (for New Business)</th>
        <?php else:?>
        <th class="text-center" colspan="2">Gross/Sales Receipts (for Renewal)</th>
        <?php endif;?>
        <?php if(can_edit()):?>
        <th rowspan="2"></th>
        <?php endif;?>
    </tr>
    <tr>
        <?php if(!$application->isNew):?>
        <th class="text-center">Essential</th>
        <th class="text-center">Non-Essential</th>
            <?php endif;?>
    </tr>
    <?php foreach($business_activities as $ba):?>
    <tr id="ba-<?=$ba->id?>">
        <td class="text-center"><?=$ba->line_of_business?></td>
        <td class="text-center"><?=$ba->no_of_units?></td>
        <?php if($application->isNew):?>
        <td class="text-center"><?=$ba->capitalization?></td>
        <?php else:?>
        <td class="text-center"><?=$ba->essential_receipts?></td>
        <td class="text-center"><?=$ba->non_essential_receipts?></td>
        <?php endif;?>
        <?php if(can_edit()):?>
        <td class="text-center"><a href="#ba-<?=$ba->id?>" class="text-danger"><i class="fa fa-trash"></i></a> <a class="text-secondary" href="#ba-<?=$ba->id?>"><i class="fa fa-pen"></i></a></td>
        <?php endif;?>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td>No data found..</td>
    </tr>
    <?php endif;?>
</table>
<div class="text-right">
    <?php if(can_add()): ?>
    <button class="btn btn-primary">Add</button>
    <?php endif;?>
</div>