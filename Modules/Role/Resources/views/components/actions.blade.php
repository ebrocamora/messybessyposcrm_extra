@can('view-role')
<a href="{{route('role.view', $role)}}" class="btn btn-xs btn-outline-info"><i class="fas fa-eye"></i></a>
@endcan

@can('edit-role')
    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-xs btn-outline-primary">
        <i class="fa fa-pencil-alt"></i>
    </a>
@endcan()

@can('delete-role')
    <button class="btn btn-xs btn-outline-danger" onclick="deleteRole('{{$role->id}}', '{{$role->name}}')"><i
            class="fa fa-trash"></i></button>
@endcan
