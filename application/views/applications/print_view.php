<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome/css/all.min.css">
        <script src="<?php echo base_url();?>assets/js/jquery-3.4.0.min.js"></script>
    </head>
    <style>
        table, th, td{
            border: 1px solid black;
        }
        table{
            border-collapse: collapse;
        }

        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right;
        }

        .box{
            border: 1px solid black;
            font-size: 8px;
        }

        .nbr{
            border-right: 0px;
        }

        .nbl{
            border-left: 0px;
        }

        tbody, body{
            font-size: 13px;
            font-weight: bold;
        }

        td{
            padding-right: 5px;
            padding-left: 5px;
        }

        .bold{
            font-weight: bold;
        }

        table.not, th.not, td.not{
            border: 0px;
        }

        .check{
            font-size: 13px;
        }

        .light{
            font-weight: lighter;
        }
    </style>
    <?php 
        $check = '<span class="box">&nbsp;<i class="fa fa-check check"></i>&nbsp;&nbsp;</span>';
        $uncheck = '<span class="box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
        $isset = isset($application);
        $business = array();
        $business_address = array();
        $owner = array();
        $emergency = array();
        $business_details = array();
        $lessor_d = false;
        $lessor = false;
        $activities = array();
        $verifications= array();
        $assessments = array();
        if($isset){
            $business = $application->get_business();
            $owner = $business->get_owner();
            $business_address = $business->get_business_address();
            $emergency = $business->get_emergency_contact_details();
            $business_details = $business->get_business_details();
            $lessor_d = $business->get_lessor_details();
            if($lessor_d != false){
                $lessor = $lessor_d->get_lessor();
            }
            $activities = $application->get_business_activities();
            $verifications = $application->get_verifications();
            $assessments = $application->get_assessments();
        }

        if(!count($verifications)){
            $verifications = $this->Verification_Document_List_Model->get_all();
        }

        if(!count($assessments)){
            $assessments = $this->Assessment_Fees_List_Model->get_all();
        }


    ?>
    <body style="font-family: calibri, serif">
        <div style="width: 100%">
            <table class="bold" style="width: 100%;">
                <tbody>
                    <tr>
                        <td colspan="6"><b>ANNEX 1 (Page 1 of 2)</b></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="text-center">
                                <b>APPLICATION FORM FOR BUSINESS PERMIT
                                <br>
                                TAX YEAR:
                                <?php if(isset($application)): ?>
                                <span style="border-bottom: 1px solid black;"><?=$application->get_date_of_application("Y")?></span>
                                <?php else:?>
                                _____________
                                <?php endif;?>
                                <br>
                                CITY/MUNICIPALITY: <span style="border-bottom: 1px solid black;">Lian, Batangas</span>
                                </b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="font-weight: bold;">
                            INSTRUCTIONS:
                            <ol>
                                <li>
                                    Provide accurate information and print legibly to avoid delays. 
                                    Incomplete application form will be returned.</li>
                                <li>
                                    Ensure that all documents attached to this form (if any) are complete and
                                    properly filled out.
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="font-weight: bold">I. APPLICANT SECTION</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="padding-left: 5em;">1. BASIC INFORMATION</td>
                    </tr>
                    <tr>
                        <td class="text-center" style="border-right: 0px;">
                            <?=$isset ? ($application->isNew ? $check : $uncheck) : $uncheck ?> New
                        </td>
                        <td style="border-left: 0px;">
                            <?=$isset ? (!$application->isNew ? $check : $uncheck) : $uncheck ?> Renewal
                        </td>
                        <td style="border-right: 0px">
                            Mode of Payment:
                        </td>
                        <td style="border-left: 0px; border-right: 0px">
                            <?=$isset ? ($business->mode_of_payment == "Annually" ? $check : $uncheck) : $uncheck ?> Annually
                        </td>
                        <td style="border-left: 0px; border-right: 0px">
                            <?=$isset ? ($business->mode_of_payment == "Semi-Annually" ? $check : $uncheck) : $uncheck ?> Semi-Annually
                        </td>
                        <td style="border-left: 0px;">
                            <?=$isset ? ($business->mode_of_payment == "Quarterly" ? $check : $uncheck) : $uncheck ?> Quarterly
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Date of Application: <span class="light"><?=$isset ? $application->get_date_of_application() : "" ?></span>
                        </td>
                        <td colspan="3">
                            DTI/SEC/CDA Registration No.: <span class="light"><?=$isset ? $business->dti_reg_no : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            TIN No.: <span class="light"><?=$isset ? $owner->tin : "" ?></span>
                        </td>
                        <td colspan="3">
                            DTI/SEC/CDA Date of Registration: <span class="light"><?=$isset ? $business->get_dti_reg_date() : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="nbr">
                            Type of Business:
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($business->type == "Single" ? $check : $uncheck) : $uncheck ?> Single
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($business->type == "Partnership" ? $check : $uncheck) : $uncheck ?> Partnership
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($business->type == "Corporation" ? $check : $uncheck) : $uncheck ?> Corporation
                        </td>
                        <td class="nbl">
                            <?=$isset ? ($business->type == "Cooperative" ? $check : $uncheck) : $uncheck ?> Cooperative
                        </td>
                    </tr>
                    <tr>
                        <td class="nbr">
                            Amendment:
                        </td>
                        <td class="nbr nbl">
                            From
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_from == "Single" ? $check : $uncheck) : $uncheck ?> Single
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_from == "Partnership" ? $check : $uncheck) : $uncheck ?> Partnership
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_from == "Corporation" ? $check : $uncheck) : $uncheck ?> Corporation
                        </td>
                        <td class="nbl"></td>
                    </tr>
                    <tr>
                        <td class="nbr"></td>
                        <td class="nbr nbl">
                            To
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_to == "Single" ? $check : $uncheck) : $uncheck ?> Single
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_to == "Partnership" ? $check : $uncheck) : $uncheck ?> Partnership
                        </td>
                        <td class="nbr nbl">
                            <?=$isset ? ($application->amendment_to == "Corporation" ? $check : $uncheck) : $uncheck ?> Corporation
                        </td>
                        <td class="nbl"></td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            Are you enjoying tax incentive from any Government Entity? 
                            <?=$isset ? ($business->tax_incentives != "" ? $check : $uncheck) : $uncheck ?> Yes 
                            <?=$isset ? ($business->tax_incentives == "" ? $check : $uncheck) : $uncheck ?> No 
                            Please specify the entity? <?=$isset ? $business->tax_incentives : "" ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="text-center">
                                Name of Taxpayer/Registrant
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Last Name: <span class="light"><?=$isset ? $owner->last_name : "" ?></span>
                        </td>
                        <td colspan="2">
                            First Name: <span class="light"><?=$isset ? $owner->first_name : "" ?></span>
                        </td>
                        <td colspan="2">
                            Middle Name: <span class="light"><?=$isset ? $owner->middle_name : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Business Name: <span class="light"><?=$isset ? $business->business_name : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Trade name / Franchise: <span class="light"><?=$isset ? $business->trade_name : "" ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="padding-left: 5em;">
                            2. OTHER INFORMATION
                            <br>
                            Note: <u>For renewal applications,</u> do not fill up this section unless certain
                            information have changed.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Business Address: <span class="light"><?=$isset ? $business_address->get_full_address() : "" ?></span></td>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Postal Code: <span class="light"><?=$isset ? $business_address->postal_code : "" ?></span>
                        </td>
                        <td colspan="3">
                            Email Address: <span class="light"><?=$isset ? $business_address->email : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Telephone No.: <span class="light"><?=$isset ? $business_address->telephone : "" ?></span></td>
                        <td colspan="3">Mobile No.: <span class="light"><?=$isset ? $business_address->mobile : "" ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Owner's Address: <span class="light"><?=$isset ? $owner->get_full_address() : "" ?></span>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Postal Code: <span class="light"><?=$isset ? $owner->postal_code : "" ?></span>
                        </td>
                        <td colspan="3">
                            Email Address: <span class="light"><?=$isset ? $owner->email : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Telephone No.: <span class="light"><?=$isset ? $owner->telephone : "" ?></span>
                        </td>
                        <td colspan="3">
                            Mobile No.: <span class="light"><?=$isset ? $owner->mobile : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            In case of emergency, provide name of contract person: <span class="light"><?=$isset ? $emergency->full_name : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Telephone/Mobile No.: <span class="light"><?=$isset ? $emergency->telephone : "" ?></span></td>
                        <td colspan="3">Email Address: <span class="light"><?=$isset ? $emergency->email : "" ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Business Area (in sq m.):
                            <br><span class="light"><?=$isset ? $business_details->business_area : "" ?></span>
                        </td>
                        <td colspan="2">
                            Total No. of Employees in Establishment:
                            <br><span class="light"><?=$isset ? $business_details->total_no_employees : "" ?></span>
                        </td>
                        <td colspan="2">
                            No. of Employees Residing with LGU:
                            <br><span class="light"><?=$isset ? $business_details->no_lgu_residing : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Note: Fill up only if business place is rented
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Lessor's Full Name: <span class="light"><?=$isset ? ($lessor == false ? "" : $lessor->full_name) : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Lessor's Full Address: <span class="light"><?=$isset ? ($lessor == false ? "" : $lessor->full_address) : "" ?></span> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Lessor's Full Telephone/Mobile No.: <span class="light"><?=$isset ? ($lessor == false ? "" : $lessor->contact) : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Lessor's Email Address: <span class="light"><?=$isset ? ($lessor == false ? "" : $lessor->email) : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Montly Rental: <span class="light"><?=$isset ? ($lessor_d == false ? "" : "Php. ".$lessor_d->monthly_rental) : "" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="padding-left: 5em;">
                            3. BUSINESS ACTIVITY:
                        </td>
                    </tr>
                    <tr>
                        <td  class="text-center" colspan="2" rowspan="2">
                            Line of Business
                        </td>
                        <td  class="text-center" rowspan="2">
                            No. of Units
                        </td>
                        <td  class="text-center" rowspan="2">
                            Capitalization<br>
                            (for New Business)
                        </td>
                        <td  class="text-center" colspan="2">
                            Gross/Sales Receipts (for Renewal)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            Essential
                        </td>
                        <td class="text-center">
                            Non-Essential
                        </td>
                    </tr>
                    <?php $count = 5-count($activities);?>
                    <?php if($isset):?>
                    <?php foreach($activities as $a):?>
                    <tr>
                        <td class="text-center" colspan="2"><span class="light"><?=$a->line_of_business?></span></td>
                        <td class="text-center"><span class="light"><?=$a->no_of_units?></span></td>
                        <td class="text-center"><span class="light"><?=number_format($a->capitalization, 2)?></span></td>
                        <td class="text-center"><span class="light"><?=$a->essential_receipts?></span></td>
                        <td class="text-center"><span class="light"><?=$a->non_essential_receipts?></span></td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <?php for($i = 0; $i < $count; $i++):?>
                    <tr>
                        <td colspan="2"></td>
                        <td><br></td>
                        <td><br></td>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <?php endfor;?>
                    <tr>
                        <td colspan="6">
                            <br>
                            <div style="padding: 5px">
                            I DECLARE UNDER PENALTY OF PERJURY that the foregoing information are true based on my personal
                            knowledge and authentic records. Further, I agree to comply with the regulatory requirement and other deficiences
                            within 30 days from release of the business permit.
                            </div>
                            <br>
                            <div style="text-align: right">
                                <table class="not" style="position: absolute; right: 40px">
                                    <tr>
                                        <td class="not" style="border-bottom: 1px solid black"></td>
                                    </tr>
                                    <tr>
                                        <td class="not text-center">SIGNATURE OF APPLICANT/TAXPAYER OVER PRINTED NAME</td>
                                    </tr>
                                    <tr>
                                        <td class="not"><br/></td>
                                    </tr>
                                    <tr>
                                        <td class="not" style="border-bottom: 1px solid black"></td>
                                    </tr>
                                    <tr>
                                        <td class="not text-center">POSITION/TITLE</td>
                                    </tr>
                                </table>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                            </div>
                            <br/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Page 2 of 2 -->
        <div style="margin-top: 40px">
            <table style="width: 100%;">
                <tbody style="font-size: 12px; font-weight: bold">
                    <tr>
                        <td colspan="12">
                            ANNEX 1 (Page 2 of 2) Application Form for Business Permit
                        </td>
                    </tr>
                    <tr>
                        <Td colspan="12">II. LGU SECTION (Do not fill up this section</Td>
                    </tr>
                    <tr>
                        <td colspan="12">1. VERIFICATION OF DOCUMENTS</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">Description</td>
                        <td colspan="4" class="text-center">Office/Agency</td>
                        <td colspan="1" class="text-center">Yes</td>
                        <td colspan="1" class="text-center">No</td>
                        <td colspan="2" class="text-center">Not Needed</td>
                    </tr>
                    <?php if(count($verifications)):?>
                    <?php foreach($verifications as $v):?>
                    <tr>
                        <td class="text-center" colspan="4"><span class="light"><?=$v->description?></span></td>
                        <td class="text-center" colspan="4"><span class="light"><?=$v->office_agency?></span></td>
                        <td class="text-center" colspan="1"><span class="light"><?=isset($v->remarks) ? ($v->remarks == "Yes" ? $v->remarks : "") : ""?></span></td>
                        <td class="text-center" colspan="1"><span class="light"><?=isset($v->remarks) ? ($v->remarks == "No" ? $v->remarks : "") : ""?></span></td>
                        <td class="text-center" colspan="2"><span class="light"><?=isset($v->remarks) ? ($v->remarks == "Not Needed" ? $v->remarks : "") : ""?></span></td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <tr>
                        <td colspan="12">
                            <div style="text-align: right">
                                <table class="not" style="position: absolute; right: 40px">
                                    <tr>
                                        <td class="not">Verified by: BPLO</td>
                                    </tr>
                                    <tr>
                                        <td class="not"><br/></td>
                                    </tr>
                                    <tr>
                                        <td class="not" style="border-bottom: 1px solid black"></td>
                                    </tr>
                                    <tr>
                                        <td class="not text-center">{ ENTER BPO }</td>
                                    </tr>
                                </table>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            2. ASSESSMENT OF APPLICABLE FEES
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">Local Taxes</td>
                        <td colspan="2" class="text-center">Amount Due</td>
                        <td colspan="2" class="text-center">Penalty/Subcharge</td>
                        <td colspan="2" class="text-center">Total</td>
                    </tr>
                    <?php $total = 0; ?>
                    <?php if(count($assessments)):?>
                    <?php foreach($assessments as $a):?>
                    <tr>
                        <td colspan="6"><?=$a->local_taxes?></td>
                        <td class="text-center" colspan="2"><span class="light"><?=isset($a->amount_due) ? number_format($a->amount_due, 2) : "" ?></span></td>
                        <td class="text-center" colspan="2"><span class="light"><?=isset($a->penalty_subcharge) ? number_format($a->penalty_subcharge, 2) : "" ?></span></td>
                        <td class="text-center" colspan="2"><span class="light"></span><?=isset($a->amount_due) && isset($a->penalty_subcharge) ? number_format($a->amount_due + $a->penalty_subcharge, 2) : "" ?></span></td>
                        <?php if(isset($a->amount_due) && isset($a->penalty_subcharge))
                                $total += $a->amount_due + $a->penalty_subcharge;
                        ?>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    <tr>
                        <td class="text-right" colspan="10">TOTAL FEES for LGU: </td>
                        <td colspan="2">Php. <?=number_format($total, 2)?></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="10">FIRE SAFETY INSPECTION FEE (10%): </td>
                        <td colspan="2">Php. <?=number_format($total*.10, 2)?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 0px" class="text-center" colspan="6">
                            Assessed by: CTO<br>
                            ________________________<br/><br/>
                        </td>
                        <td style="border-bottom: 0px" class="text-center" colspan="6">
                            FSIF Assessment Approved by: BFP<br/>
                            ________________________<br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px dashed black" colspan="12">
                            III. CITY/MUNICIPALITY FIRE STATION SECTION
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" style="border-bottom: 0px">
                            <div class="text-right">
                                <b>DATE:</b> <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="text-left">
                                <b>APPLICATION NO.: </b> <span style="border-bottom: 1px solid black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=($isset ? $application->id : "")?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div>
                                <table style="width: 100%" class="not">
                                    <tr>
                                        <td class="not" style="width: 25%">Name of Application/Owner:</td>
                                        <td class="not text-center" colspan="3" style="border-bottom: 1px solid black"><?= $isset ? $owner->get_full_name() : ""?></td>
                                    </tr>
                                    <tr>
                                        <td class="not">Name of Business:</td>
                                        <td class="not text-center" colspan="3" style="border-bottom: 1px solid black"><?= $isset? $business->business_name : ""?></td>
                                    </tr>
                                    <tr>
                                        <td class="not">Total Floor Area:</td>
                                        <td class="not text-center" style="width: 20%; border-bottom: 1px solid black"><?=$isset ? number_format($business_details->business_area, 2) : ""?></td>
                                        <td class="not" style="border-bottom: 0px;">Contact No.:</td>
                                        <td class="not text-center" style="width: 25%; border-bottom: 1px solid black"><?=$isset ? $owner->mobile : ""?></td>
                                    </tr>
                                    <tr>
                                        <td class="not">Addess of Establishment:</td>
                                        <td class="not" colspan="3" style="border-bottom: 1px solid black"></td>
                                    </tr>
                                </table>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="nbr" style="border-top: 0px" colspan="6">
                            ________________________________________<br/>
                            Signature of Applicant/Owner
                            <br/><br/>
                            Certified by:<br/>
                            Customer Relation Officer<br/>
                            Time and Date Received: ________________________<br/>
                        </td>
                        <td class="nbl" style="border-top: 0px" colspan="6">
                            <table style="width: 250px; position: absolute; right: 45px;">
                                <tr>
                                    <td>FIRE SAFETY INSPECTION<br>
                                    FEE ASSESSMENT:
                                    </td>
                                    <td style="width: 40%">
                                        Php. <?=($total*.10 != 0 ? number_format($total*.10, 2):"")?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <b style="font-size: 11px;">Important Notice: As per Section 12 of the implementing Rules and Regulations of the Fire Code of 2008,
            certain establishments (e.g. building, lessor, fire, earthquake, and explosion hazard insurance companies,
            and vendors of the fire fighting equipment, appliances and devices) may be required to pay additional charges
            and fees other than the Fire Safety Inspection Fees. These shall be collected during inspection or in another
            process to be communicated by representatives of the Bureau of Fire Protection (BFP).</b>
        </div>
    </body>
</html>
<script>
    $(function(){
        $(window).on("load", function(){
            alert("Don't forget to set the size to A4.");
            window.print();
        })
    });
</script>