@extends('link::layouts.master')
@section('content_header')
    <h1><i class="fas fa-link"></i> Links</h1>
@stop

@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <template slot="header">
                    <i class="el-icon-view text-primary"></i> View Link
                </template>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width: 30%">Title</th>
                            <td>{{ $link->title }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $link->description }}</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td>{{ $link->url }}</td>
                        </tr>
                        <tr>
                            <th>Icon</th>
                            <td>{{ $link->icon }}</td>
                        </tr>
                        <tr>
                            <th>Active Pattern</th>
                            <td>{{ $link->active_pattern }}</td>
                        </tr>
                        <tr>
                            <th>Order</th>
                            <td>{{ $link->order }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $link->status }}</td>
                        </tr>
                        <tr>
                            <th>Permission</th>
                            <td>{{ $link->permission->name ?? '' }}</td>
                        </tr>

                        <tr>
                            <th>Application</th>
                            <td>{{ $link->application->name ?? '' }}</td>
                        </tr>

                        <tr>
                            <th>Group</th>
                            <td>{{ $link->resource_group->name ?? '' }}</td>
                        </tr>

                        <tr>
                            <th>Parent Link</th>
                            <td>{{ $link->parent_link->title ?? '' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <el-row>
                    <a href="{{route('link.index')}}">
                        <el-button icon="el-icon-back">Back</el-button>
                    </a>
                </el-row>
            </el-card>
        </el-col>
    </el-row>
@stop
@section('js')
    <script>
        new Vue({el: '.content'});
    </script>
@stop
