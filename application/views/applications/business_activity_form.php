<div id="taxes-form">
    <?php $isset = isset($business_activity);?>
    <input type="hidden" name="action">
    <input  type="hidden" name="id">
    <label>Line of Business:</label>
    <input class="form-control" value="<?=$isset ? $business_activity->line_of_business : ""?>" type="text" name="line_of_business">
    <br>
    <label>No of Units:</label>
    <input class="form-control" value="<?=$isset ? $business_activity->no_of_units : ""?>" type="text" name="no_of_units">
    <?php if($isNew):?>
    <br>
    <label>Capitalizations:</label>
    <input class="form-control" value="<?=$isset ? $business_activity->capitalization : ""?>" type="text" name="capitalization">
    <?php else:?>
    <br>
    <label>Gross/Sales Receipts (Essentials)</label>
    <input class="form-control" value="<?=$isset ? $business_activity->essential_receipts : ""?>" type="text" name="capitalization">
    <br>
    <label>Gross/Sales Receipts (Non-Essentials)</label>
    <input class="form-control" value="<?=$isset ? $business_activity->non_essential_receipts : ""?>" type="text" name="capitalization">
    <?php endif ;?>
</div>