<?php 
    $business_address = $business->get_business_address();
    $business_details = $business->get_business_details();
    $emergency_contact = $business->get_emergency_contact_details();
    $lessor_details = $business->get_lessor_details();
    if($lessor_details){
        $lessor = $lessor = $lessor_details->get_lessor();
    }
?>
<div style="text-align: right">
    <?php if(can_edit()):?>
        <button class="btn btn-secondary gModal-btn" data-app_id="<?=$application->id?>" data-gaction="edit_other_information"  data-id="<?=$business->id?>" data-base_url="<?=base_url().add_index()?>">Edit</button>
    <?php endif;?>
</div>
    <h5>OTHER INFORMATION</h5>
    <table class="table table-sm table-bordered table-hover">
        <tr>
            <td colspan="12">Business Address: <span class="value"><?=$business_address->get_full_address()?></span></td>
        </tr>
        <tr>
            <td colspan="6" style="width: 50%">Postal Code: <span class="value"><?=$business_address->postal_code?></span></td>
            <td colspan="6" style="width: 50%">Email Address: <span class="value"><?=$business_address->email?></span></td>
        </tr>
        <tr>
            <td colspan="6" style="width: 50%">Telephone No: <span class="value"><?=$business_address->telephone?></span></td>
            <td colspan="6" style="width: 50%">Mobile No: <span class="value"><?=$business_address->mobile?></span></td>
        </tr>
        <tr>
            <td colspan="12">Emergency Contact Person: <span class="value"><?=$emergency_contact->full_name?></span></td>
        </tr>
        <tr>
            <td colspan="6" style="width: 50%">Telephone/Mobile No: <span class="value"><?=$emergency_contact->telephone?></span></td>
            <td colspan="6" style="width: 50%">Email Address: <span class="value"><?=$emergency_contact->email?></span></td>
        </tr>
        <tr>
                <td colspan="4">Business Area (in sq. m): <span class="value"><?=$business_details->business_area?></span></td>
                <td colspan="4">Total No. of Employees in Establishment: <span class="value"><?=$business_details->total_no_employees?></span></td>
                <td colspan="4">No. of Employees Residing within LGU: <span class="value"><?=$business_details->no_lgu_residing?></span></td>
        </tr>
        <?php if($lessor_details): ?>
        <tr>
            <td colspan="12" style="text-align: center"><b>Lessor Details</b></td>
        </tr>
        <tr>
            <td colspan="12">Lessor's Full Name: <span class="value"><?=$lessor->full_name?></span></td>
        </tr>
        <tr>
            <td colspan="12">Lessor's Full Address: <span class="value"><?=$lessor->full_address?></span></td>
        </tr>
        <tr>
            <td colspan="12">Lessor's Full Telephone / Mobile No.: <span class="value"><?=$lessor->contact?></span></td>
        </tr>
        <tr>
            <td colspan="12">Lessor's Email Address: <span class="value"><?=$lessor->email?></span></td>
        </tr>
        <tr>
            <td colspan="12">Monthly Rental: <span class="value"><?=$lessor_details->monthly_rental?></span></td>
        </tr>
        <?php endif;?>
</table>
<script src="<?php echo base_url();?>assets/js/bpm_lian.js"></script>
