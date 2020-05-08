@extends('role::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-tag"></i> {{plural(config('role.name'))}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-view text-primary"></i> View Role</div>
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <td>@{{ form.name }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>@{{ form.description }}</td>
                            </tr>
                            <tr>
                                <th>Permissions</th>
                                <td>
                                    <el-tag v-for="permission in form.permissions" effect="plain" class="mr-1 mb-1">@{{ permission.name }}</el-tag>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <a href="{{route('role.index')}}">
                            <el-button type="default" icon="el-icon-back">Back</el-button>
                        </a>
                    </div>
                </div>
            </el-card>
        </el-col>
    </el-row>
@stop

@section('js')
    <script>
        new Vue({
            el: '.content',
            data() {
                return {
                    form: {
                        name: '',
                        description: '',
                        permissions: [],
                    },
                }
            },
            mounted() {
                axios.get('{{route('api.role.find', $id)}}')
                    .then(res => {
                        this.form = res.data;
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });
            },
            computed: {},
            methods: {}
        });
    </script>
@stop
