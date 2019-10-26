<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<div class="text-right">
    <button type="button" class="btn btn-secondary gModal-btn" data-business_id="<?=$business->id?>" data-id="<?=$ba->id?>" data-gaction="edit_business_address" data-base_url="<?=base_url().add_index()?>">Edit</button>
</div>
<br>
<table class="table table-hover">
    <tbody>
        <tr>
            <th>Street:</th>
            <td><?=$ba->street?></td>
        </tr>
        <tr>
            <th>Barangay:</th>
            <td><?=$ba->brgy?></td>
        </tr>
        <tr>
            <th>Postal Code:</th>
            <td><?=$ba->postal_code?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$ba->email?></td>
        </tr>
        <tr>
            <th>Postal Code:</th>
            <td><?=$ba->postal_code?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$ba->email?></td>
        </tr>
        <tr>
            <th>Mobile:</th>
            <td><?=$ba->mobile?></td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td><?=$ba->telephone?></td>
        </tr>
    </tbody>
</table>