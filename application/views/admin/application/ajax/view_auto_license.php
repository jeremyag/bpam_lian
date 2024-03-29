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
        <div class="option" data-license="<?=$r->bp_no?>" data-val="<?=$r->bp_no . " - " . $r->business_name ?>" data-real="<?=$r->id?>">
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
        $("#business_id").val(real);
        $("#registration_no").addClass("border-success");
        $("#registration_no").removeClass("border-danger");
        $("#loading").css("display", "none");
        $("#wrong").css("display", "none");
        $("#ok").css("display", "block");
        $("#auto-search").empty();

        let license = $(this).data("license");
        $.ajax({
            url: "<?=base_url().add_index()?>Application_Controller/auto_license_message",
            dataType: "html",
            type: "get",
            data: {
                license_no: license
            },
            success: function(html){
                $("#message").empty();
                $("#message").append(html);
            }
        });
    });
</script>