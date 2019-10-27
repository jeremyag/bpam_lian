<div class="row">
    <div class="col-md-4">
        <div class="alert alert-info">
            Total no. of Applications:<br>
            <h3 class="text-center" id="total_no_of_applications">0</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-warning">
            No. of Unfinished Applications:
            <h3 class="text-center" id="total_no_of_unfinished_applications">0</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">
            No. of Finished Applications
            <h3 class="text-center" id="total_no_of_finished_applications">0</h3>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "<?=base_url().add_index()?>analytics/card",
                dataType: "json",
                data: {
                    all: 1
                },
                success: function(data){
                    $("#total_no_of_applications").text(data.total_no_of_applications);
                    $("#total_no_of_unfinished_applications").text(data.total_no_of_unfinished_applications);
                    $("#total_no_of_finished_applications").text(data.total_no_of_finished_applications);
                }
            });
        });
    </script>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                INSERT CHART HERE.
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
