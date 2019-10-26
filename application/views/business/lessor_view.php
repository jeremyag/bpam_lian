<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<div class="text-right">
    <button type="button" class="btn btn-secondary gModal-btn" data-business_id="<?=$business->id?>" data-id="<?=$ld->id?>" data-lessor_id="<?=$l->id?>" data-gaction="edit_lessor" data-base_url="<?=base_url().add_index()?>">Edit</button>
</div>
<br>
<table class="table table-hover">
    <tbody>
        <tr>
            <th>Full Name:</th>
            <td><?=$l->full_name?></td>
        </tr>
        <tr>
            <th>Full Address:</th>
            <td><?=$l->full_address?></td>
        </tr>
        <tr>
            <th>Contact:</th>
            <td><?=$l->contact?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$l->email?></td>
        </tr>
        <tr>
            <th>Monthly Rent:</th>
            <td>Php. <?=number_format($ld->monthly_rental, 2)?></td>
        </tr>
    </tbody>
</table>