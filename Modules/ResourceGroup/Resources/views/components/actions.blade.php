@can('edit-resourcegroup')
    <a href="{{ route('resourcegroup.edit', $resourcegroup->id) }}" class="btn btn-xs btn-outline-primary">
        <i class="fa fa-pencil-alt"></i>
    </a>
@endcan()

@can('delete-resourcegroup')
    <button class="btn btn-xs btn-outline-danger" onclick="deleteGroup('{{$resourcegroup->id}}', '{{$resourcegroup->name}}')"><i class="fa fa-trash"></i></button>
@endcan
