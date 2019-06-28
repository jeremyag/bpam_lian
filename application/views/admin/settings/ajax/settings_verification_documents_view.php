<h5>Verification Documents</h5>
<hr>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Description</th>
            <th>Office Agency</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($verifications)):?>
        <?php foreach($verifications as $v):?>
        <tr>
            <td><?=$v->description?></td>
            <td><?=$v->office_agency?></td>
            <td class="text-center"><a href="#" data-base_url="<?=base_url().add_index()?>" data-gaction="edit_verification_document" data-id="<?=$v->id?>" class="gModal-btn"><i class="fa fa-pen text-primary"></a></i> <a data-base_url="<?=base_url().add_index()?>" data-gaction="delete_verification_document" data-id="<?=$v->id?>" class="gModal-btn" href="#"><i class="fa fa-trash text-danger"></i></a></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<div class="text-right">
    <button type="button" data-base_url="<?=base_url().add_index()?>" data-gaction="add_verification_document" class="btn btn-success gModal-btn"><i class="fa fa-plus"></i> Add</button>
</div>
<script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>