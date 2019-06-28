<input type="hidden" name="id" value="<?=$b ? $b->id : "" ?>">
<input type="hidden" name="action" value="<?=$action?>">
<label>Name:</label>
<input <?=$disabled?> name="name" class="form-control" type="text" value="<?=$b ? $b->name : "" ?>">