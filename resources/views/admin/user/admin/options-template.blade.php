<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.users.admins.edit', [$user]) }}">Edit</a></li>
        @if(!$user->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $user->id }}').submit();">Delete</a></li>
        @endif
        @if($user->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#restore-form-{{ $user->id }}').submit();">Restore</a></li>
        @endif
    </ul>
</div>

<form method="POST" action="{{ route('admin.users.admins.destroy', [$user]) }}" id="delete-form-{{ $user->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form method="POST" action="{{ route('admin.users.admins.restore', [$user]) }}" id="restore-form-{{ $user->id }}" style="display: none;">
    @csrf
    @method('PUT')
</form>
