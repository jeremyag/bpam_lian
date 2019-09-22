<table class="table table-hover">
    <thead>
        <tr>
            <th>License No.:</th>
            <th>Date Start:</th>
            <th>Date End:</th>
            <th>Status:</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($l)):?>
        <?php foreach($l as $a):?>
        <tr class="table-<?=$a->get_bootstrap_color()?>">
            <td><?=$a->license_no?></td>
            <td><?=$a->date_start?></td>
            <td><?=$a->date_end?></td>
            <td><?=$a->get_status()?></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>