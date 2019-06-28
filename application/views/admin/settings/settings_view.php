<div class="row">
    <div class="col-md-3">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <i class="fa fa-cogs"></i> Settings
            </div>
            <ul class="list-group list-group-flush">
                <a id="general-settings" href="#general-settings" class="settings-option list-group-item list-group-item-action bg-light">
                    <i class="fa fa-cog"></i> General
                </a>
                <a id="assessment-fees" href="#assessment-fees" class="settings-option list-group-item list-group-item-action">
                    <i class="fa fa-money-bill"></i> Assessment Fees
                </a>
                <a id="verification-documents" href="#verification-documents" class="settings-option list-group-item list-group-item-action">
                    <i class="fa fa-file"></i> Verification Documents
                </a>
                <a id="business-categories" href="#business-categories" class="settings-option list-group-item list-group-item-action">
                    <i class="fa fa-list"></i> Business Categories
                </a>
                <a id="barangay-list" href="#barangay-list" class="settings-option list-group-item list-group-item-action">
                    <i class="fa fa-map"></i> Barangay Lists
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
        let _link = '<?=base_url().add_index()?>Settings_Controller/general_settings';

        $(".settings-option").removeClass("bg-light");
        $("#general-settings").addClass("bg-light");

        $.ajax({
            url: _link,
            dataType: "html",
            success: function(html){
                $("#loading").css("display", "none");
                $("#setting-body").append(html);
            }
        });


        $(".settings-option").on("click", function(){
            $("#loading").css("display", "block");
            $("#setting-body").empty();

            let _link = '<?=base_url().add_index()?>Settings_Controller/';

            let id = $(this).attr("id");

            if(id === "general-settings"){
                _link += "general_settings";
            }
            else if(id === "assessment-fees"){
                _link += "settings_assessments";
            }
            

            $(".settings-option").removeClass("bg-light");
            $("#"+id).addClass("bg-light");

            $.ajax({
                url: _link,
                dataType: "html",
                success: function(html){
                    $("#loading").css("display", "none");
                    $("#setting-body").append(html);
                }
            });
        });
    });
</script>