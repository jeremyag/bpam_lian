<div id="taxes-form">
    <input type="hidden" name="action" value="<?=$action?>">
    <input  type="hidden" name="id" value="<?=($tax->id ? $tax->id : 0)?>">
    <label>Local Taxes:</label>
    <input class="form-control" <?=$action == 'delete' ? 'disabled' : ''?> value="<?=$tax->local_taxes?>" type="text" name="local_taxes">
</div>