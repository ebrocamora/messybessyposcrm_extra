@extends('resourcegroup::layouts.master')
@section('content_header')
    <h1><i class="fas fa-folder"></i> {{ plural(config('resourcegroup.name')) }}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-plus text-primary"></i> Create Resource Group</div>
                <div>
                    <el-form :model="form" :rules="rules" ref="createForm" @submit.native.prevent="submitForm('createForm')">
                        <el-form-item label="Application Group" prop="application">
                            <el-select v-model="form.application" clearable filterable value-key="id" class="w-100">
                                <el-option v-for="application in applications"
                                           :value="application"
                                           :label="application.name"
                                           :key="application.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="Name" prop="name">
                            <el-input v-model="form.name"></el-input>
                        </el-form-item>

                        <el-form-item label="Description">
                            <el-input v-model="form.description" type="textarea"></el-input>
                        </el-form-item>

                        <el-form-item label="Icon" prop="icon">
                            <el-input v-model="form.icon"></el-input>
                        </el-form-item>

                        <el-form-item class="text-right">
                            <el-button type="primary" native-type="submit" icon="el-icon-check"> Save
                            </el-button>
                            <a href="{{route('resourcegroup.index')}}">
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
                    form: {
                        application: null,
                        name: null,
                        description: null,
                        icon: 'fa-fa-list'
                    },
                    applications: null,
                    rules: {
                        name: {required: true, message: 'Please input application name.'},
                        application: {required: true, message: 'Please input resource application group.'},
                        icon: {required: true, message: 'Please input resource group icon.'},
                    }
                }
            },
            mounted() {
                axios.get('/api/application')
                    .then(res => this.applications = res.data)
                    .catch(err => new ErrorHandler().handle(err.response));
            },
            computed: {},
            methods: {
                submitForm(formRefs) {
                    this.$refs[formRefs].validate((valid) => {
                        if (valid) {
                            axios.post('{{route('api.resourcegroup.store')}}', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            window.location = '{{route('resourcegroup.index')}}'
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
