@extends('layouts.minimal')
@section('css')
    <style>
        html, body, #app, main {
            height: 100%!important;
        }

        .el-card {
            margin-top: auto;
            margin-bottom: auto;
            width: 400px;
        }
    </style>
@stop
@section('content')
    <div class="container h-100 align-content-center">
        <div class="d-flex justify-content-center h-100">
            <el-card class="box-card" shadow="always">
                <span>You have logged out of {{config('app.name')}}.</span>
                <br>
                Click <a href="{{ route('login') }}">here</a> to sign in.
            </el-card>
        </div>
    </div>
@stop

@section('js')
    <script>
        new Vue({el: '#app'});
    </script>
@stop
