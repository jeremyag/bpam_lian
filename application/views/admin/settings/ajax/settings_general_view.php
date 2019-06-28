<h5>General Settings</h5>
<hr>
<?php if(count($settings)):?>
<?php foreach($settings as $s):?>
<b><?=$s->name?>:</b>
<div class="input-group mb-3">
    <input type="text" value="<?=$s->settings_value?>" class="form-control" disabled>
    <div class="input-group-append">
        <button data-base_url="<?=base_url().add_index()?>" data-gaction="settings_edit_general" data-id="<?=$s->id?>" class="btn btn-outline-secondary gModal-btn" type="button" id="button-addon2"><i class="fa fa-pen"></i> Change</button>
    </div>
</div>
<?php endforeach;?>
<?php endif;?>
<script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>