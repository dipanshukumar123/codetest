<table class="table table-sm table-borderless m-0">
    <tbody>
    <tr>
        <td width="25%" style="padding: .3rem;">Name: {{ $class->name }}</td>
        <td width="25%">No. of Cycles: {{ $class->class_cycles_count }}</td>
        <td width="20%">Duration: {{ $class->duration }}</td>
        <td width="30%">Duration Label: {{ $class->duration_label }}</td>
    </tr>
    <tr>
        <td style="padding: .3rem;">Seat Price: {{ $class->seat_price }}</td>
        <td>Floor Price: {{ $class->floor_price }}</td>
        <td>
            App Visibility:
            @if ($class->app_visibility == 1)
                <span class="badge badge-primary">Show</span>
            @else
                <span class="badge badge-danger">Hide</span>
            @endif
        </td>
        <td>
            Status:
            @if ($class->status == 1)
                <span class="badge badge-primary">Active</span>
            @else
                <span class="badge badge-danger">Inactive</span>
            @endif
        </td>
    </tr>
    </tbody>
</table>
