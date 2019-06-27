<style>
    .option:hover{
        background-color: #007bff; color: white;
    }

    .option{
        cursor: pointer;
    }
</style>
<div style="border: 1px solid #8dc4ff; border-radius: 5px; padding: 5px 0px 0px 0px; margin-top: 5px; background: white; position: absolute; width: 96%;">
    <?php if(count($results)):?>
    <?php foreach($results as $r):?>
        <div class="option" data-val="<?=$r->bp_no . " - " . $r->business_name ?>" data-real="<?=$r->id?>">
            <?=$r->bp_no . " - " . $r->business_name ?>
        </div>
    <?php endforeach;?>
    <?php else:?>
    <div>
        No results.
    </div>
    <?php endif;?>
</div>
<script>
    $(".option").on("click", function(){
        let value = $(this).data("val");
        let real = $(this).data("real");
        $("#registration_no").val(value);
        $("#license_no").val(real);
        $("#auto-search").empty();
    });
</script>