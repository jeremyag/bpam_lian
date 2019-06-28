<input type="hidden" name="id" value="<?=$bc ? $bc->id : "" ?>">
<input type="hidden" name="action" value="<?=$action?>">
<label>Name:</label>
<input <?=$disabled?> name="name" class="form-control" type="text" value="<?=$bc ? $bc->name : "" ?>">
<label>Definition:</label>
<textarea <?=$disabled?> name="definition" class="form-control"><?=$bc ? $bc->definition : "" ?></textarea>