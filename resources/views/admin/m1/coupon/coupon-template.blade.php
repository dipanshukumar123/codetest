<table class="table table-sm table-borderless m-0">
    <tbody>
    <tr>
        <td width="25%" style="padding: .3rem;">Name: {{ $coupon->name }}</td>
        <td width="25%">Code: {{ $coupon->code }}</td>
        <td width="25%">Type: {{ $coupon->discount_type == 1 ? 'Fixed' : 'Percentage' }}</td>
        <td width="25%">Discount: {{ $coupon->discount }}</td>
    </tr>
    <tr>
        <td style="padding: .3rem;">Validity: {{ $coupon->disp_validity }}</td>
        <td>Total Usage: {{ $coupon->total_usage }}</td>
        <td>Usage Per User: {{ $coupon->usage_per_user }}</td>
        <td>
            Status:
            @if ($coupon->status == 1)
                <span class="badge badge-primary">Active</span>
            @else
                <span class="badge badge-danger">Inactive</span>
            @endif
        </td>
    </tr>
    </tbody>
</table>
