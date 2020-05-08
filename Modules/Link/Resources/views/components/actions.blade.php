@can('view-link')
    <a href="{{route('link.show', $link)}}" class="btn btn-xs btn-outline-info"><i class="fas fa-eye"></i></a>
@endcan

@can('edit-link')
    <a href="{{ route('link.edit', $link) }}" class="btn btn-xs btn-outline-primary mr-1"><i class="fa fa-pencil-alt"></i></a>
@endcan

@can('delete-link')
    <button onclick="deleteLink('{{$link->id}}')" class="btn btn-xs btn-outline-danger" data-toggle="modal"
            data-target="#modal-delete-link-{{$link->id}}"><i
            class="fa fa-trash"></i>
    </button>
    <!-- Modal -->
    <div class="modal" id="modal-delete-link-{{$link->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-left">
                <form action="{{ route('link.delete', $link) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Delete link "<strong>{{$link->title}}</strong>"?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan
