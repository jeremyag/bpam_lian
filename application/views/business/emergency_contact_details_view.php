<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<div class="text-right">
    <button type="button" class="btn btn-secondary gModal-btn" data-business_id="<?=$business->id?>" data-id="<?=$ecd->id?>" data-gaction="edit_emergency_contact_details" data-base_url="<?=base_url().add_index()?>">Edit</button>
</div>
<br>
<table class="table table-hover">
    <tbody>
        <tr>
            <th>Full Name:</th>
            <td><?=$ecd->full_name?></td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td><?=$ecd->telephone?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$ecd->email?></td>
        </tr>
    </tbody>
</table>