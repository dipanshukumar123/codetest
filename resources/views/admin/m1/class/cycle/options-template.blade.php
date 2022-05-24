<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default border-0 bg-transparent" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></button>
    <ul class="dropdown-menu dropdown-menu-right">
        @if($cycle->status == 0)
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#active-form-{{ $cycle->id }}').submit();">Active</a></li>
        @endif
        @if($cycle->status == 1)
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#inactive-form-{{ $cycle->id }}').submit();">Inactive</a></li>
        @endif
    </ul>
</div>

<form method="POST" action="{{ route('admin.m1.classes.cycles.update', [$cycle->class_id, $cycle]) }}" id="active-form-{{ $cycle->id }}" style="display: none;">
    @csrf
    @method('PUT')

    <input type="text" name="status" value="1" class="form-control">
</form>

<form method="POST" action="{{ route('admin.m1.classes.cycles.update', [$cycle->class_id, $cycle]) }}" id="inactive-form-{{ $cycle->id }}" style="display: none;">
    @csrf
    @method('PUT')

    <input type="text" name="status" value="0" class="form-control">
</form>

