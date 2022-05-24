<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.m1.packages.edit', [$package]) }}">Edit</a></li>
        @if(!$package->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $package->id }}').submit();">Delete</a></li>
        @endif
        @if($package->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#restore-form-{{ $package->id }}').submit();">Restore</a></li>
        @endif
    </ul>
</div>

<form method="POST" action="{{ route('admin.m1.packages.destroy', [$package]) }}" id="delete-form-{{ $package->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form method="POST" action="{{ route('admin.m1.packages.restore', [$package]) }}" id="restore-form-{{ $package->id }}" style="display: none;">
    @csrf
    @method('PUT')
</form>
