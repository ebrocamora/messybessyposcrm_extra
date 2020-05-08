@extends('user::layouts.master')
@section('content_header')
    <h1><i class="fas fa-users"></i> {{plural(config('user.name'))}}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $builder->table() !!}
    </div>
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        applyHeaderSearch('users');
    </script>
@endpush
