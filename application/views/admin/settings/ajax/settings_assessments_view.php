<h5>Assessment Fees</h5>
<hr>
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Local Taxes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($taxes)>0):?>
        <?php foreach($taxes as $t):?>
        <tr>
            <td><?= $t->local_taxes?></td>
            <td class="text-center">
                <a class="gModal-btn" data-gaction="settings_edit_tax" data-id="<?=$t->id?>" data-base_url="<?=base_url().add_index()?>" href="#"><i class="fa fa-pen"></i></a> 
                <a class="gModal-btn" data-gaction="settings_delete_tax" data-id="<?=$t->id?>" data-base_url="<?=base_url().add_index()?>" href="#"><i class="fa fa-trash text-danger"></i></a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php endif; ?>
    </tbody>
</table>
<div class="text-right">
    <button class="btn btn-success gModal-btn" data-gaction="settings_add_tax" data-base_url="<?=base_url().add_index()?>"><i class="fa fa-plus"></i> Add</button>
</div>
<script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>