<div id="taxes-form">
    <?php $isset = isset($business_activity);?>
    <input type="hidden" name="application_id" value="<?=$isset ? $application->id : ""?>">
    <input  type="hidden" name="id" value="<?=$isset ? $business_activity->id : ""?>">
    <label>Line of Business:</label>
    <input class="form-control" value="<?=$isset ? $business_activity->line_of_business : ""?>" type="text" name="line_of_business">
    <br>
    <label>No of Units:</label>
    <input class="form-control" value="<?=$isset ? $business_activity->no_of_units : ""?>" type="text" name="no_of_units">
    <br>
    <label <?=$isNew ? "" : "style='display: none;'"?>>Capitalizations:</label>
    <input class="form-control" value="<?=$isset ? ($business_activity->capitalization != "" ? $business_activity->capitalization : "NULL") : "NULL"?>" type="<?=$isNew ? "text" : "hidden"?>" name="capitalization">
    <br>
    <label <?=$isNew ? "style='display: none;'" : ""?>>Gross/Sales Receipts (Essentials)</label>
    <input class="form-control" value="<?=$isset ? ($business_activity->essential_receipts != "" ? $business_activity->essential_receipts : "NULL") : "NULL"?>" type="<?=$isNew ? "hidden" : "text"?>" name="gross_sales_essential">
    <br>
    <label <?=$isNew ? "style='display: none;'" : ""?>>Gross/Sales Receipts (Non-Essentials)</label>
    <input class="form-control" value="<?=$isset ? ($business_activity->non_essential_receipts != "" ? $business_activity->non_essential_receipts : "NULL") : "NULL"?>" type="<?=$isNew ? "hidden" : "text"?>" name="gross_sales_non_essentials">
</div>