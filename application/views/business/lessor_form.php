<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<br>
<table class="table table-hover">
    <tbody>
        <input type="hidden" value="<?=$business->id?>" name="business_id">
        <input type="hidden" value="<?=$l->id?>" name="lessor_id">
        <input type="hidden" value="<?=$ld->id?>" name="lessor_details_id">
        <tr>
            <th>Full Name:</th>
            <td>
                <input class="form-control" type="text" name="full_name" value="<?=$l->full_name?>">
            </td>
        </tr>
        <tr>
            <th>Full Address:</th>
            <td>
                <textarea class="form-control" type="text" name="full_address"><?=$l->full_address?></textarea>
            </td>
        </tr>
        <tr>
            <th>Contact:</th>
            <td>
                <input class="form-control" type="text" name="contact" value="<?=$l->contact?>">
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                <input class="form-control" type="text" name="email" value="<?=$l->email?>">
            </td>
        </tr>
        <tr>
            <th>Monthly Rent:</th>
            <td>(Php.) <input class="form-control" type="number" name="monthly_rental" value="<?=$ld->monthly_rental?>">
            </td>
        </tr>
    </tbody>
</table>