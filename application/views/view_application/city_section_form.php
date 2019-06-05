<?php if($status->isAssessed):?>
<h2 style="text-align: center">Application #<?=$application->id?></h2>
<br>
<h5>CITY/MUNICIPALITY FIRE STATION SECTION</h5>
<div class="card">
<div class="card-body">
    <div class="text-right">
        <b>DATE:</b> <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </div>
    <div class="text-left">
        <b>APPLICATION NO.: </b> <span style="border-bottom: 1px solid black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: x-large; font-weight: bold"><?=$application->id?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </div>
    <div>
        <table style="width: 100%">
            <tr>
                <td style="width: 25%">Name of Application/Owner:</td>
                <td colspan="3" style="border-bottom: 1px solid black"></td>
            </tr>
            <tr>
                <td>Name of Business:</td>
                <td colspan="3" style="border-bottom: 1px solid black"></td>
            </tr>
            <tr>
                <td>Total Floor Area:</td>
                <td style="width: 20%; border-bottom: 1px solid black"></td>
                <td>Contact No.:</td>
                <td style="width: 25%; border-bottom: 1px solid black"></td>
            </tr>
            <tr>
                <td>Addess of Establishment:</td>
                <td colspan="3" style="border-bottom: 1px solid black"></td>
            </tr>
        </table>
    </div>
</div>
</div>
<?php else:?>
<div class="alert alert-danger"><b>Alert:</b> This application hasn't been assessed!</div>
<?php endif;?>