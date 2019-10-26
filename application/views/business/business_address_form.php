<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<table class="table table-hover">
    <tbody>
        <input type="hidden" value="<?=$business->id?>" name="business_id">
        <input type="hidden" value="<?=$ba->id?>" name="business_address_id">
        <tr>
            <th>Street:</th>
            <td>
                <textarea name="street" class="form-control"><?=$ba->street?></textarea>
            </td>
        </tr>
        <tr>
            <th>Barangay:</th>
            <td>
                <?php 
                echo form_dropdown(array(
                'class'=>'form-control',
                    'name'=>'brgy'
                ), $brgy, $ba->brgy)?>
            </td>
        </tr>
        <tr>
            <th>Postal Code:</th>
            <td>
                <input type="text" value="<?=$ba->postal_code?>" name="postal_code" class="form-control">
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                <input type="email" value="<?=$ba->email?>" name="email" class="form-control">
            </td>
        </tr>
        <tr>
            <th>Mobile:</th>
            <td>
                <input type="text" value="<?=$ba->mobile?>" name="mobile" class="form-control">
            </td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td>
                <input type="text" value="<?=$ba->telephone?>" name="telephone" class="form-control">
            </td>
        </tr>
    </tbody>
</table>