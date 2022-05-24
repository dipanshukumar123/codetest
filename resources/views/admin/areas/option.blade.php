<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.areas.edit', [$area]) }}">Edit</a></li>
        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $area->id }}').submit();">Delete</a></li>
    </ul>
</div>

<form method="POST" action="{{ route('admin.areas.destroy', [$area]) }}" id="delete-form-{{ $area->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

{{--<form method="POST" action="{{ route('admin.users.admins.restore', [$area]) }}" id="restore-form-{{ $area->id }}" style="display: none;">--}}
    {{--@csrf--}}
    {{--@method('PUT')--}}
{{--</form>--}}

