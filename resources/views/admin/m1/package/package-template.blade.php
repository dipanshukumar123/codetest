<table class="table table-sm table-borderless m-0">
    <tbody>
    <tr>
        <td rowspan="4" class="p-0"><img src="{{ $package->image_url }}" onerror="this.onerror=null; this.src='{{ asset('themes/AdminLTE/dist/img/default-1000x500.png') }}';" alt="" class="img-rounded" width="120" height="auto"></td>
    </tr>
    <tr>
        <td width="25%" class="pl-3" style="padding: .3rem;">Name: {{ $package->name }}</td>
        <td width="25%">No. of Classes: {{ $package->num_classes }}</td>
        <td width="20%">Validity: {{ $package->validity }}</td>
        <td width="30%">Validity Label: {{ $package->validity_label }}</td>
    </tr>
    <tr>
        <td class="pl-3" style="padding: .3rem;">Sort Order: {{ $package->sort_order }}</td>
        <td>Price: {{ $package->price }}</td>
        <td>
            App Visibility:
            @if ($package->app_visibility == 1)
                <span class="badge badge-primary">Show</span>
            @else
                <span class="badge badge-danger">Hide</span>
            @endif
        </td>
        <td>
            Status:
            @if ($package->status == 1)
                <span class="badge badge-primary">Active</span>
            @else
                <span class="badge badge-danger">Inactive</span>
            @endif
        </td>
    </tr>
    </tbody>
</table>
