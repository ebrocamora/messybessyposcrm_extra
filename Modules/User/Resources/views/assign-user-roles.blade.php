@extends('adminlte::page')
@section('content_header')
    <h1><i class="fas fa-user-tag"></i> User Role(s)</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-form label-width="120px" label-position="left" @submit.native.prevent="submitForm">
                <el-card>
                    <template slot="header">
                        <i class="el-icon-plus text-primary"></i> Assign Role(s)
                    </template>
                    <el-form-item label="ID Number">
                        <el-input readonly value="{{$user->id_number}}"></el-input>
                    </el-form-item>
                    <el-form-item label="Name">
                        <el-input value="{{$user->name}}" readonly></el-input>
                    </el-form-item>
                    <el-form-item label="Email">
                        <el-input readonly value="{{$user->email}}"></el-input>
                    </el-form-item>
                    <el-form-item label="Type">
                        <el-input readonly value="{{$user->type}}"></el-input>
                    </el-form-item>

                    <template>
                        <i class="el-icon-collection-tag text-primary"></i> Roles
                        <hr>
                    </template>
                    <el-checkbox-group v-model="form.roles">
                        @foreach ($roles as $role)
                            <el-checkbox label="{{$role->id}}">{{$role->name}}</el-checkbox>
                        @endforeach
                    </el-checkbox-group>
                    <el-row class="pt-2 text-right">
                        <el-button native-type="submit" type="primary" icon="el-icon-check">Submit</el-button>
                        <a href="{{route('user.index')}}">
                            <el-button type="default" icon="el-icon-close">Cancel</el-button>
                        </a>
                    </el-row>
                </el-card>
            </el-form>
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
                        roles: {!! $user->roles->pluck('id') !!}
                    }
                }
            },
            methods: {
                submitForm() {
                    if (this.form.roles.length < 1) {
                        ElementUI.Notification.error('Please select role(s) to assign.');
                    } else {
                        axios.put('{{route('api.user.assign.roles', $user)}}', this.form)
                            .then(res => {
                                swal('Success', '{{$user->name}} role(s) updated!', 'success')
                                    .then(val => {
                                        window.location = '/user';
                                    });
                            }).catch(err => new ErrorHandler().handle(err.response));
                    }
                }
            }
        });
    </script>
@stop
