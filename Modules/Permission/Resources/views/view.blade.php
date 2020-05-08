@extends('permission::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Permissions</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <template slot="header">
                    <i class="el-icon-view text-primary"></i> View Permission
                </template>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$permission->name}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$permission->title}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$permission->description}}</td>
                        </tr>
                        <tr>
                            <th>Active</th>
                            <td>{{$permission->active}}</td>
                        </tr>
                        <tr>
                            <th>Application</th>
                            <td>{{$permission->application->name}}</td>
                        </tr>
                        <tr>
                            <th>Group</th>
                            <td>{{$permission->resource_group->name}}</td>
                        </tr>
                        <tr>
                            <th>Belongs to Role(s)</th>
                            <td>
                                @foreach ($permission->roles as $role)
                                    <el-tag class="mb-1">{{$role->name}}</el-tag>
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <a href="/user">
                    <el-button type="default" icon="el-icon-back">Back</el-button>
                </a>
            </el-card>
        </el-col>
    </el-row>
@stop
@section('js')
    <script>
        new Vue({el: '.content'});
    </script>
@stop
