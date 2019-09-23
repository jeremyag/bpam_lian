<div class="row">
    <table class="table">
        <tbody>
            <input type="hidden" value="<?=$bd->id?>" name="business_details_id">
            <tr>
                <th>Business Area (in sq m.):</th>
                <td>
                    <input type="text" class="form-control" value="<?=$bd->business_area?>" name="business_area">
                </td>
            </tr>
        <tr>
                <th>Total No. of Employees:</th>
                <td>
                    <input type="text" class="form-control" value="<?=$bd->total_no_employees?>" name="total_no_employees">
                </td>
            </tr>
            <tr>
                <th>No. LGU residing:</th>
                <td>
                    <input type="text" class="form-control" value="<?=$bd->no_lgu_residing?>" name="no_lgu_residing">
                </td>
            </tr>
        </tbody>
    </table>
</div>