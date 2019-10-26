<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<table class="table table-hover">
    <tbody>
        <tr>
            <input type="hidden" value="<?=$business->id?>" name="business_id">
            <input type="hidden" value="<?=$o->id?>" name="owner_id">
            <th>TIN:</th>
            <td>
                <input class="form-control" type="text" name="tin" value="<?=$o->tin?>">
            </td>
        </tr>
        <tr>
            <th>Last name:</th>
            <td>
                <input class="form-control" type="text" name="last_name" value="<?=$o->last_name?>">
            </td>
        </tr>
        <tr>
            <th>First name:</th>
            <td>
                <input class="form-control" type="text" name="first_name" value="<?=$o->first_name?>">
            </td>
        </tr>
        <tr>
            <th>Middle name:</th>
            <td>
                <input class="form-control" type="text" name="middle_name" value="<?=$o->middle_name?>">
            </td>
        </tr>
        <tr>
            <th>Street:</th>
            <td>
                <input class="form-control" type="text" name="middle_name" value="<?=$o->street?>">
            </td>
        </tr>
        <tr>
            <th>Barangay:</th>
            <td>
                <input class="form-control" type="text" name="brgy" value="<?=$o->brgy?>">
            </td>
        </tr>
        <tr>
            <th>City/Municipality:</th>
            <td>
                <input class="form-control" type="text" name="city" value="<?=$o->city?>">
            </td>
        </tr>
        <tr>
            <th>Province:</th>
            <td>
                <input class="form-control" type="text" name="province" value="<?=$o->province?>">
            </td>
        </tr>
        <tr>
            <th>Postal Code:</th>
            <td>
                <input class="form-control" type="text" name="postal_code" value="<?=$o->postal_code?>">
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                <input class="form-control" type="text" name="email" value="<?=$o->email?>">
            </td>
        </tr>
        <tr>
            <th>Mobile:</th>
            <td>
                <input class="form-control" type="text" name="mobile" value="<?=$o->mobile?>">
            </td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td>
                <input class="form-control" type="text" name="telephone" value="<?=$o->telephone?>">
            </td>
        </tr>
    </tbody>
</table>