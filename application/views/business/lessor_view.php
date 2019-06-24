<table class="table table-hover">
    <tbody>
        <tr>
            <th>Full Name:</th>
            <td><?=$l->full_name?></td>
        </tr>
        <tr>
            <th>Full Address:</th>
            <td><?=$l->full_address?></td>
        </tr>
        <tr>
            <th>Contact:</th>
            <td><?=$l->contact?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?=$l->email?></td>
        </tr>
        <tr>
            <th>Monthly Rent:</th>
            <td>Php. <?=number_format($ld->monthly_rental, 2)?></td>
        </tr>
    </tbody>
</table>