<div class="row">
    <div class="col-md-3">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <i class="fa fa-cog"></i> Settings
            </div>
            <ul class="list-group list-group-flush">
                <a id="assessment-fees" href="#assessment-fees" class="list-group-item list-group-item-action">
                    <i class="fa fa-money-bill text-success"></i> Assessment Fees
                </a>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <span id="setting-title">Settings</span>
            </div>
            <div class="card-body">
                <div id="loading" class="text-center">
                    <img src="<?=base_url()?>assets/img/loading.gif">
                </div>
                <br>
                <div id="setting-body">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        let assessments_fees = '<?=base_url().add_index()?>Settings_Controller/settings_assessments';

        $("#assessment-fees").on("click", function(){
            $("#loading").css("display", "block");

            $("#assessment-fees").addClass("bg-light");

            $.ajax({
                url: assessments_fees,
                dataType: "html",
                success: function(html){
                    $("#loading").css("display", "none");
                    $("#setting-body").empty();
                    $("#setting-body").append(html);
                }
            });
        });
    });
</script>