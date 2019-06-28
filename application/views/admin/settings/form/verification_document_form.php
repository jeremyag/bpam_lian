<input type="hidden" name="id" value="<?=$v ? $v->id : ""?>">
<label>Description:</label>
<input <?=$disabled?> type="text" class="form-control" name="description" value="<?=$v ? $v->description : ""?>">
<br>
<label>Office Agency:</label>
<input <?=$disabled?> type="text" class="form-control" name="office_agency" value="<?=$v ? $v->office_agency : ""?>">