<?php if(count($applications)):?>
<?php foreach($applications as $a):?>
<?php 
    $color = "";
    $status = $a->get_status();

    if($status->isVerified == 0){
        $color = "table-danger";
    }
    elseif($status->verifyAgain == 1){
        $color = "table-warning";
    }
    elseif($status->isVerified == 1 && $status->verifyAgain == 0 && $status->isAssessed == 0){
        $color = "table-success";
    }
    elseif($status->isAssessed == 1){
        $color = "table-primary";
    }

    $isVerified = ($a->get_current_status() == "unverified" || $a->get_current_status() == "missing-docs" ? '<i class="fa fa-times-circle text-danger"></i>' : '<i class="fa fa-check-circle text-success"></i>');
    $isAssessed = ($a->get_current_status() == "done" ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>');
?>
<tr class="<?=$color?> row-clickable" onclick="rowClick('view_application','id','<?=$a->id?>')">
    <?php $b = $a->get_business(); ?>
    <td><?=$a->id?></td>
    <td><?=$a->get_type()?></td>
    <td><?=$b->business_name?></td>
    <td><?=$a->get_date_of_application()?></td>
    <td><?=$b->dti_reg_no?></td>
    <td><?=$b->get_owner()->get_full_name() ?></td>
    <td class="text-center"><?=$isVerified?></td>
    <td class="text-center"><?=$isAssessed?></td>
</tr>
<?php endforeach;?>
<?php endif;?>