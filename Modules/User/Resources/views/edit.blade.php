@extends('user::layouts.master')
@section('content_header')
    <h1>{{config('user.name')}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-edit text-primary"></i> Edit User</div>
                <div>
                    <el-form :model="form" :rules="rules" ref="editForm" @submit.native.prevent="submitForm('editForm')">
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
                            axios.put('{{route('api.user.update', $id)}}', this.form)
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
