<br>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger text-right">
            <a href="<?php echo base_url().add_index();?>admin/step1" class="btn btn-danger btn-lg"><i class="fa fa-folder-plus"></i> New Application</a>
            <a href="<?php echo base_url().add_index();?>Application_Controller/print" target="_blank" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Print Form</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Applications</h2>
            </div>
            <div class="card-body">
                <div id="loading" class="text-center">
                    <img src="<?=base_url()?>assets/img/loading.gif">
                </div>
                <div id="content"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#loading").css("display", "block");
        $("#content").empty();

        $.ajax({
            url: "<?=base_url().add_index()?>Application_Controller/application_list",
            dataType: "html",
            type: "get",
            data: {
                show:1
            },
            success: function (html) {
                $("#loading").css("display", "none");
                $("#content").append(html);
            }
        });
    });
</script>