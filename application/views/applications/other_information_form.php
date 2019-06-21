<?php 
    $isset = isset($business);
    if($isset){
        $owner = $business->get_owner();
        $business_address = $business->get_business_address();
        $business_details = $business->get_business_details();
        $emergency_contact = $business->get_emergency_contact_details();
        $lessor_details = $business->get_lessor_details();
        if($lessor_details){
            $lessor = $lessor = $lessor_details->get_lessor();
        }
    }
?>
<h4>2. OTHER INFORMATION</h4>
<div class="card card-body">
    <h5>Business Address:</h5>
    <div class="row">
        <div class="col-md-12">
            <label>Street/Sitio:</label>
            <?php echo form_textarea(array(
                'class'=>'form-control',
                'name'=>'form_business_sitio',
                'rows'=>'2',
            ),($isset ? $business_address->street : ''))?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label>Barangay:</label>
<!-- TODO: Update Barangays-->
            <?php echo form_dropdown(array(
                'class'=>'form-control',
                'name'=>'form_business_brgy'
            ), array(
                'Brgy. 2'=>'Brgy. 2',
                'Brgy. 1'=>'Brgy 1'
            ), ($isset ? $business_address->brgy : ''))?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Postal Code:</label>
            <?php
                echo form_input(array(
                    'class'=>'form-control',
                    'name'=>'form_business_postal',
                    'value'=>($isset ? $business_address->postal_code : '')
                ))
            ?>
        </div>
        <div class="col-md-6">
            <label>Email Address:</label>
            <?php echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_business_email',
                'type'=>'email',
                'value'=>($isset ? $business_address->email : '')
            ))?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Telephone No.:</label>
            <?php
                echo form_input(array(
                    'class'=>'form-control',
                    'name'=>'form_business_tel_no',
                    'value'=>($isset ? $business_address->telephone : '')
                ))
            ?>
        </div>
        <div class="col-md-6">
            <label>Mobile No.:</label>
            <?php echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_business_mobile_no',
                'value'=>($isset ? $business_address->mobile : '')
            ))?>
        </div>
    </div>
</div>
<br>
<div class="card card-body">
    <h5>Owner's Address:</h5>
    <div class="row">
        <div class="col-md-12">
            <label>Street/Sitio:</label>
            <?php echo form_textarea(array(
                'class'=>'form-control',
                'name'=>'form_owner_sitio',
                'rows'=>'2'
            ), ($isset ? $owner->street : ''))?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label>Barangay:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_brgy',
                'value'=>($isset ? $owner->brgy : '')
            ))
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label>Municipality/City:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_municipality',
                'value'=>($isset ? $owner->city : '')
            ))
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label>Province:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_province',
                'value'=>($isset ? $owner->province : '')
            ))
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Postal Code:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_postal',
                'value'=>($isset ? $owner->postal_code : '')
            ))
            ?>
        </div>
        <div class="col-md-6">
            <label>Email Address:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_email',
                'type'=>'email',
                'value'=>($isset ? $owner->email : '')
            ))
            ?>
        </div>
    </div>
        <br>
    <div class="row">
        <div class="col-md-6">
            <label>Telephone No.:</label>
            <?php
                echo form_input(array(
                    'class'=>'form-control',
                    'name'=>'form_owner_tel_no',
                    'value'=>($isset ? $owner->telephone : '')
                ))
            ?>
        </div>
        <div class="col-md-6">
            <label>Mobile No.:</label>
            <?php echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_owner_mobile_no',
                'value'=>($isset ? $owner->mobile : '')
            ))?>
        </div>
    </div>
</div>
<br>
<div class="card card-body">
    <h5>In case of emergency:</h5>
    <div class="row">
        <div class="col-md-12">
            <label>Name of Contact person:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_emergency_person',
                'value'=>($isset ? $emergency_contact->full_name : '')
            ))
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Telephone/Mobile No.:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_emergency_contact',
                'value'=>($isset ? $emergency_contact->telephone : '')
            ))
            ?>
        </div>
        <div class="col-md-6">
            <label>Email Address</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_emergency_email',
                'type'=>'email',
                'value'=>($isset ? $emergency_contact->email : '')
            ))
            ?>
        </div>
    </div>
</div>
<br>
<div class="card card-body">
    <div class="row">
        <div class="col-md-4">
            <label>Business Area (in sq. m.)</label>
            <?php
                echo form_input(array(
                    'class'=>'form-control',
                    'name'=>'form_business_area',
                    'value'=>($isset ? $business_details->business_area : '')
                ))
            ?>
        </div>
        <div class="col-md-4">
            <label>Total No. of Employees in Establishment</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_employee_no',
                'type'=>'number',
                'value'=>($isset ? $business_details->total_no_employees : '')
            ))
            ?>
        </div>
        <div class="col-md-4">
            <label>No. of Employees Residing within LGU:</label>
            <?php
            echo form_input(array(
                'class'=>'form-control',
                'name'=>'form_employee_lgu',
                'type'=>'number',
                'value'=>($isset ? $business_details->no_lgu_residing : '')
            ))
            ?>
        </div>
    </div>
    <br>
    <?php if(isset($lessor)): ?>
    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Lessor's Full Name:</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_lessor_name',
                                'value'=>($isset ? $lessor->full_name : '')
                            ))
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Lessor's Full Address:</label>
                            <?php
                            echo form_textarea(array(
                                'class'=>'form-control',
                                'name'=>'form_lessor_address',
                                'rows'=>'2',
                                'value'=>($isset ? $lessor->full_address : '')
                            ))
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Lessor's Full Telephone/Mobile No.:</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_lessor_contact',
                                'value'=>($isset ? $lessor->contact : '')
                            ))
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Lessor's Email Address:</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_lessor_email',
                                'type'=>'email',
                                'value'=>($isset ? $lessor->email : '')
                            ))
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Monthly Rental:</label>
                            <?php
                            echo form_input(array(
                                'class'=>'form-control',
                                'name'=>'form_lessor_rental',
                                'value'=>($isset ? $lessor_details->monthly_rental : '')
                            ))
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
