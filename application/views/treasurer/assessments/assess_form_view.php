<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Local Taxes</th>
            <th>Amount Due</th>
            <th>Penalty/Subcharge</th>
            <th class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($assessment_fees_list)>0):?>
        <?php $row = 0;?>
        <?php foreach($assessment_fees_list as $a):?>
        <tr>
            <td><?=$a->local_taxes?></td>
            <input type="hidden" value="" name="assess[<?=$row?>][id]">
            <input type="hidden" value="<?=$this->input->get("id");?>" name="assess[<?=$row?>][application_id]">
            <input type="hidden" value="<?=$a->local_taxes?>" name="assess[<?=$row?>][local_taxes]" >
            <td><input value="0.00" data-row="<?=$row?>" name="assess[<?=$row?>][amount_due]" class="amount_due auto-compute form-control number-only-textbox row-<?=$row?>"></td>
            <td><input value="0.00" data-row="<?=$row?>" name="assess[<?=$row?>][penalty_subcharge]" class="penalty auto-compute form-control row-<?=$row?>"></td>
            <th class="text-center total row-<?=$row?>"></th>
        </tr>
        <?php $row++;?>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<script>
    $(function(){
        $(".auto-compute").on("keyup", function(e){
            if(isKeyPressNum(e.which)){
                let me = $(this);
                let row = me.data("row");

                let amount_due = $(".amount_due.row-"+row).val();
                let penalty = $(".penalty.row-"+row).val();
                let total = parseFloat(amount_due) + parseFloat(penalty);

                $(".total.row-"+row).html(total);
            }
        });
    });
</script>