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