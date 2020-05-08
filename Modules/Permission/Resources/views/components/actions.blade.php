@can('view-permission')
    <a href="{{route('permission.show', $permission)}}" class="btn btn-xs btn-outline-info"><i
            class="fas fa-eye"></i></a>
@endcan

@can('edit-permission')
    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-xs btn-outline-primary">
        <i class="fa fa-pencil-alt"></i>
    </a>
@endcan()

@can('delete-permission')
    <button class="btn btn-xs btn-outline-danger"
            onclick="deletePermission('{{$permission->id}}', '{{$permission->name}}')"><i class="fa fa-trash"></i>
    </button>
@endcan
