<div>
    <label>License No.:</label>
    <input class="form-control" type="text" required name="license_no">
    <br>
    <label>Start Date:</label>
    <input class="form-control" type="date" required name="date_start" value="<?=date("Y-m-d")?>">
    <br>
    <label>End Date:</label>
    <input class="form-control" type="date" required name="date_end">
    <input type="hidden" value="<?=$business_id?>" name="business_id">
    <input type="hidden" value="<?=$application_id?>" name="application_id">
</div>