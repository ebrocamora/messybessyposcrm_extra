@extends('user::layouts.master')
@section('content_header')
    <h1>{{config('user.name')}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-plus text-primary"></i> Create User</div>
                <div>
                    <el-form :model="form" :rules="rules" ref="createForm" @submit.native.prevent="submitForm('createForm')">
                        <h1>Form here</h1>
                        <el-form-item class="text-right">
                            <el-button type="primary" native-type="submit" icon="el-icon-check"> Save</el-button>
                            <a href="{{route('user.index')}}">
                                <el-button type="default" icon="el-icon-close">Cancel</el-button>
                            </a>
                        </el-form-item>
                    </el-form>
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
                    form: {},
                    rules:{}
                }
            },
            mounted() {
                //execute scripts on page ready
            },
            computed:{
            },
            methods: {
                submitForm(formRefs){
                    this.$refs[formRefs].validate((valid) => {
                        if (valid) {
                            axios.post('{{route('api.user.store')}}', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            window.location = '{{route('user.index')}}'
                                        });
                                })
                                .catch(err => {
                                    new ErrorHandler().handle(err.response);
                                });
                        } else {
                            ElementUI.Notification.error('Please input required fields.');
                            return false;
                        }
                    });
                }
            }
        });
    </script>
@stop
