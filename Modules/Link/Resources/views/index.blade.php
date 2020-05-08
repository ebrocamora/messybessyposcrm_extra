@extends('link::layouts.master')
@section('content_header')
    <h1><i class="fas fa-link"></i> {{plural(config('link.name'))}}</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        {!! $html->table() !!}
    </div>
@endsection

@push('js')
    {!! $html->scripts() !!}
    <script>
        applyHeaderSearch('links');
    </script>
@endpush
