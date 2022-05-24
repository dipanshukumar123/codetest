<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('admin.m1.classes.edit', [$class]) }}">Edit</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.m1.classes.cycles.index', [$class]) }}">Cycles</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.m1.classes.schedule.index', [$class]) }}">Schedule</a></li>
        @if(!$class->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#delete-form-{{ $class->id }}').submit();">Delete</a></li>
        @endif
        @if($class->trashed())
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#restore-form-{{ $class->id }}').submit();">Restore</a></li>
        @endif
    </ul>
</div>

<form method="POST" action="{{ route('admin.m1.classes.destroy', [$class]) }}" id="delete-form-{{ $class->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form method="POST" action="{{ route('admin.m1.classes.restore', [$class]) }}" id="restore-form-{{ $class->id }}" style="display: none;">
    @csrf
    @method('PUT')
</form>
