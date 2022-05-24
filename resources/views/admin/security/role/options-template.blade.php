<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.security.roles.edit', [$role]) }}">Edit</a></li>
        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $role->id }}').submit();">Delete</a></li>
    </ul>
</div>

<form method="POST" action="{{ route('admin.security.roles.destroy', [$role]) }}" id="delete-form-{{ $role->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
