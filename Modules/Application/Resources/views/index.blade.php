@extends('application::layouts.master')
@section('content_header')
    <h1><i class="fas fa-list"></i> {{plural(config('application.name'))}}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $builder->table() !!}
    </div>
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        applyHeaderSearch('applications');

        function deleteApplication(id, name) {
            swal({
                icon: 'warning',
                title: 'Delete',
                text: 'Delete application ' + name + '?',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete){
                    axios.delete('/api/application/' + id)
                        .then(res => {
                            swal('Success', 'Application deleted!', 'success').then(val => {
                                window.LaravelDataTables["applications"].ajax.reload(null, false);
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
