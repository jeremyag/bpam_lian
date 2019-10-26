<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<div class="text-right">
    <button type="button" class="btn btn-secondary gModal-btn" data-business_id="<?=$business->id?>" data-id="<?=$o->id?>" data-gaction="edit_owner_details" data-base_url="<?=base_url().add_index()?>">Edit</button>
</div>
<br>
<table class="table table-hover">
    <tbody>
        <tr>
            <th>TIN:</th>
            <td><?=$o->tin?></td>
        </tr>
        <tr>
            <th>Last name:</th>
            <td><?=$o->last_name?></td>
        </tr>
        <tr>
            <th>First name:</th>
            <td><?=$o->first_name?></td>
        </tr>
        <tr>
            <th>Middle name:</th>
            <td><?=$o->middle_name?></td>
        </tr>
        <tr>
            <th>Street:</th>
            <td><?=$o->street?></td>
        </tr>
        <tr>
            <th>Barangay:</th>
            <td><?=$o->brgy?></td>
        </tr>
        <tr>
            <th>City/Municipality:</th>
            <td><?=$o->city?></td>
        </tr>
        <tr>
            <th>Province:</th>
            <td><?=$o->province?></td>
        </tr>
        <tr>
            <th>Postal Code:</th>
            <td><?=$o->postal_code?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$o->email?></td>
        </tr>
        <tr>
            <th>Mobile:</th>
            <td><?=$o->mobile?></td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td><?=$o->telephone?></td>
        </tr>
    </tbody>
</table>