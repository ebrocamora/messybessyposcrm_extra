@extends('role::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-tag"></i> {{plural(config('role.name'))}}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $builder->table() !!}
    </div>
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        applyHeaderSearch('roles');

        function deleteRole(id, name) {
            swal({
                icon: 'warning',
                title: 'Delete',
                text: 'Delete role ' + name + '?',
                buttons: true,
                dangerMode: true
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('/api/role/' + id)
                            .then(res => {
                                swal('Success', 'Role deleted!', 'success').then(res => {
                                    window.LaravelDataTables['roles'].ajax.reload(null, false);
                                })
                            })
                            .catch(err => {
                                new ErrorHandler().handle(err.response);
                            });
                    }
                });
        }
    </script>
@endpush
