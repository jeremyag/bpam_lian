<script src="<?php echo base_url().add_index();?>assets/js/bpm_lian.js"></script>
<div class="text-right">
    <button type="button" data-id="<?=$bd->id?>" data-gaction="edit_business_details" data-base_url="<?=base_url().add_index()?>" class="btn btn-secondary gModal-btn">Edit</button>
</div>
<br>
<table class="table">
    <tbody>
        <tr>
            <th>Business Area (in sq m.):</th>
            <td><?=$bd->business_area?></td>
        </tr>
        <tr>
            <th>Total No. of Employees:</th>
            <td><?=$bd->total_no_employees?></td>
        </tr>
        <tr>
            <th>No. LGU residing:</th>
            <td><?=$bd->no_lgu_residing?></td>
        </tr>
    </tbody>
</table>