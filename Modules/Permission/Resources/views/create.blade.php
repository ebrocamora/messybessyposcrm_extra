@extends('permission::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-shield"></i> {{plural(config('permission.name'))}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-plus text-primary"></i> Create Permission</div>
                <div>
                    <create-permission></create-permission>
                </div>
            </el-card>
        </el-col>
    </el-row>
@stop

@section('js')
    <script>
        new Vue({
            el: '.content',
        });
    </script>
@stop
