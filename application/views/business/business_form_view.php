<div class="row">
    <table class="table table-hover col-md-12 table-sm">
        <tbody>
            <input type="hidden" value="<?=$business->id?>" name="business_id">
            <tr>
                <th>License No.:</th>
                <td><input type="text" disabled value="<?=$business->bp_no?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Trade Name:</th>
                <td><input type="text" name="form_trade_name" value="<?=$business->trade_name?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Business Name:</th>
                <td><input type="text" name="form_business_name" value="<?=$business->business_name?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Mode of Payment:</th>
                <td>
                <?php
                    echo form_dropdown(array(
                        'class'=>'form-control',
                        'name'=>'form_mode_of_payment'
                    ),array(
                        'Annually'=>'Annually',
                        'Semi-Annually'=>'Semi-Annually',
                        'Quarterly'=>'Quarterly'
                    ),$business->mode_of_payment)
                ?>
                </td>
            </tr>
            <tr>
                <th>DTI Registration No:</th>
                <td><input type="text" name="form_reg_no" value="<?=$business->dti_reg_no?>" class="form-control"></td>
            </tr>
            <tr>
                <th>DTI Registration Date:</th>
                <td><input type="date" name="form_reg_date" value="<?=$business->dti_reg_date?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Category:</th>
                <td>
                <?php

                    $business_categories = $this->Business_Categories_List_Model->get_all();
                    $categories = array();
                    foreach($business_categories as $bc){
                        $categories[$bc->name] = $bc->name;
                    }

                    echo form_dropdown(array(
                        'class'=>'form-control',
                        'name' => 'form_category'
                    ),$categories,$business->category);
                ?>
                </td>
            </tr>
            <tr>
                <th>Type:</th>
                <td>
                    <?php
                        echo form_dropdown(array(
                            'class'=>'form-control',
                            'name'=>'form_type_of_business',
                        ), array(
                            'Single'=>'Single',
                            'Partnership'=>'Partnership',
                            'Corporation'=>'Corporation',
                            'Cooperative'=>'Cooperative'
                        ),$business->type)
                    ?>
                </td>
            </tr>
            <tr>
                <th>Tax Incentives: <br><small>Note: Leave blank if no incentives.</small></th>
                <td><input type="text" name="form_tax_incentives" value="<?=$business->tax_incentives?>" class="form-control"></td>
            </tr>
        </tbody>
    </table>
</div>