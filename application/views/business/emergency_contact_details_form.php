<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<table class="table table-hover">
    <tbody>
        <input type="hidden" name="business_id" value="<?=$business->id?>">
        <input type="hidden" name="emergency_contact_details_id" value="<?=$ecd->id?>">
        <tr>
            <th>Full Name:</th>
            <td>
                <input class="form-control" type="text" name="full_name" value="<?=$ecd->full_name?>">
            </td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td>
                <input class="form-control" type="text" name="telephone" value="<?=$ecd->telephone?>">
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                <input class="form-control" type="text" name="email" value="<?=$ecd->email?>">
            </td>
        </tr>
    </tbody>
</table>