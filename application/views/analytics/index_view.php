<a href="<?=base_url().add_index()?>admin" class="btn btn-primary">Back to Home</a>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><?=$reportTitle?></h5>
            </div>
            <div class="card-body">
                <?php
                    $this->load->view(
                        $subview
                    );
                ?>
            </div>
        </div>
    </div>
</div>