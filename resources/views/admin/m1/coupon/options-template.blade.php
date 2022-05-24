<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.m1.coupons.edit', [$coupon]) }}">Edit</a></li>
        @if(!$coupon->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $coupon->id }}').submit();">Delete</a></li>
        @endif
        @if($coupon->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#restore-form-{{ $coupon->id }}').submit();">Restore</a></li>
        @endif
    </ul>
</div>

<form method="POST" action="{{ route('admin.m1.coupons.destroy', [$coupon]) }}" id="delete-form-{{ $coupon->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form method="POST" action="{{ route('admin.m1.coupons.restore', [$coupon]) }}" id="restore-form-{{ $coupon->id }}" style="display: none;">
    @csrf
    @method('PUT')
</form>
