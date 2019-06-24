<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Type</th>
            <th>Date of Application</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($as)):?>
        <?php foreach($as as $a):?>
        <tr class="table-<?=$a->get_bootstrap_color()?>">
            <td><?=$a->id?></td>
            <td><?=$a->code?></td>
            <td><?=$a->get_type()?></td>
            <td><?=$a->get_date_of_application()?></td>
            <td><?=$a->get_current_status()?></td>
            <td><a href="<?=base_url().add_index()?>admin/view_application?id=<?=$a->id?>"><i class="fa fa-book-open"></i></a></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>