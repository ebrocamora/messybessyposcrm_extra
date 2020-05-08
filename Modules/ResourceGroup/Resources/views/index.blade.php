@extends('resourcegroup::layouts.master')
@section('content_header')
    <h1><i class="fas fa-folder"></i> {{ plural(config('resourcegroup.name')) }}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $builder->table() !!}
    </div>
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        applyHeaderSearch('resourcegroups');

        function deleteGroup(id, name){
            swal({
                icon: 'warning',
                title: 'Delete',
                text: 'Delete resource group ' + name + '?',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete){
                    axios.delete('/api/resourcegroup/' + id)
                        .then(res => {
                            swal('Success', 'Resource group deleted!', 'success').then(val => {
                                window.LaravelDataTables["resourcegroups"].ajax.reload(null, false);
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
