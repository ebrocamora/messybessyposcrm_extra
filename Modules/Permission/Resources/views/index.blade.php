@extends('permission::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-shield"></i> {{plural(config('permission.name'))}}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $builder->table() !!}
    </div>
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        applyHeaderSearch('permissions');

        function deletePermission(id, name) {
            swal({
                icon: 'warning',
                title: 'Delete',
                text: 'Delete permission ' + name + '?',
                buttons: true,
                dangerMode: true
            })
                .then(action => {
                    if (action) {
                        axios.delete('/api/permission/' + id)
                            .then(res => {
                                swal('Success', 'Permission deleted!', 'success')
                                    .then(() => {
                                        window.LaravelDataTables['permissions'].ajax.reload(null, false);
                                    });
                            })
                            .catch(err => {
                                new ErrorHandler().handle(err.response);
                            });
                    }
                });
        }
    </script>
@endpush
