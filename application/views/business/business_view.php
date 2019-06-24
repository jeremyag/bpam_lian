<div class="row">
    <div class="col-md-11">
        <a href="<?=base_url().add_index()?>admin/businesses" class="btn">
            <i class="fa fa-chevron-left"></i> Back
        </a>
        <br><br>
        <div class="card">
            <div class="card-header">
                <br>
            </div>
            <div class="card-body">
                <table class="table table-hover" style="width: 70%">
                    <tbody>
                        <tr>
                            <th>License No.:</th>
                            <td><?=$business->bp_no?></td>
                        </tr>
                        <tr>
                            <th>Trade Name:</th>
                            <td><?=$business->trade_name?></td>
                        </tr>
                        <tr>
                            <th>Business Name:</th>
                            <td><?=$business->business_name?></td>
                        </tr>
                        <tr>
                            <th>Mode of Payment:</th>
                            <td><?=$business->mode_of_payment?></td>
                        </tr>
                        <tr>
                            <th>DTI Registration No:</th>
                            <td><?=$business->dti_reg_no?></td>
                        </tr>
                        <tr>
                            <th>DTI Registration Date:</th>
                            <td><?=$business->dti_reg_date?></td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td><?=$business->category?></td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td><?=$business->type?></td>
                        </tr>
                        <tr>
                            <th>Tax Incentives:</th>
                            <td><?=$business->tax_incentives?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="business_details" href="#other-information">Business Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="business_address" href="#business-activity">Business Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="owner_details" href="#business-activity">Owner Details</a>
                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="emergency_contact" href="#business-activity">Emergency Contact Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lessor" href="#business-activity">Lessor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="applications" href="#business-activity">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="licenses" href="#business-activity">Licences</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <br>
                <div id="loading" class="text-center">
                    <img src="<?=base_url()?>assets/img/loading.gif">
                </div>
                <div id="sub-info">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        let ajaxSend = function(_base_url, _data){
            $.ajax({
                url: _base_url,
                dataType: "html",
                type: "get",
                data: _data,
                success: function (html) {
                    $("#loading").css("display", "none");
                    $("#sub-info").empty();
                    $("#sub-info").append(html);
                }
            });
        }

        let _data = {
            bd_id: <?=$business->get_business_details()->id?>
        };

        let _base_url = "<?=base_url().add_index()?>_business/business_details";
        
        $(".nav-link").on("click", function(){
            $("#sub-info").empty();
            
            let id = this.id;

            $(".nav-link").removeClass("active");

            $("#"+id).addClass("active");

            $("#loading").css("display", "block");

            if(id === "business_details"){
                _base_url = "<?=base_url().add_index()?>_business/business_details";
                _data = {bd_id: <?=$business->get_business_details()->id?>};
            }
            
            if(id === "business_address"){
                _base_url = "<?=base_url().add_index()?>_business/business_address";
                _data = {ba_id: <?=$business->get_business_address()->id?>};
            }

            if(id === "owner_details"){
                _base_url = "<?=base_url().add_index()?>_business/owner_details";
                _data = {o_id: <?=$business->get_owner()->id?>};
            }

            if(id === "emergency_contact"){
                _base_url = "<?=base_url().add_index()?>_business/emergency_contact_details";
                _data = {ecd_id: <?=$business->get_emergency_contact_details()->id?>};
            }

            ajaxSend(_base_url, _data);
        });     

        ajaxSend(_base_url, _data);
    });
</script>