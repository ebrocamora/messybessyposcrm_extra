@can('edit-application')
    <a href="{{ route('application.edit', $application->id) }}" class="btn btn-xs btn-outline-primary">
        <i class="fa fa-pencil-alt"></i>
    </a>
@endcan()

@can('delete-application')
    <button class="btn btn-xs btn-outline-danger" onclick="deleteApplication('{{$application->id}}', '{{$application->name}}')"><i class="fa fa-trash"></i></button>
@endcan
