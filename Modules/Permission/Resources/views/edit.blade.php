@extends('permission::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-shield"></i> {{plural(config('permission.name'))}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-edit text-primary"></i> Edit Permission</div>
                <div>
                    <el-form :model="form" :rules="rules" ref="editForm">
                        <el-row :gutter="10">
                            <el-col :md="12">
                                <el-form-item label="Name" prop="name">
                                    <el-input v-model="form.name"></el-input>
                                </el-form-item>

                                <el-form-item label="Title" prop="title">
                                    <el-input v-model="form.title"></el-input>
                                </el-form-item>

                                <el-form-item label="Description">
                                    <el-input type="textarea" v-model="form.description"></el-input>
                                </el-form-item>
                            </el-col>

                            <el-col :md="12">
                                <el-form-item label="Application" prop="application">
                                    <el-select v-model="form.application" @change="applicationChange()" clearable
                                               filterable value-key="id"
                                               class="w-100">
                                        <el-option v-for="application in applications"
                                                   :value="application"
                                                   :label="application.name"
                                                   :key="application.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>

                                <el-form-item label="Resource Group" prop="group">
                                    <el-select v-model="form.group" clearable filterable class="w-100" value-key="id"
                                               @change="resourceGroupChange()">
                                        <el-option v-for="group in groups"
                                                   :value="group"
                                                   :label="group.name"
                                                   :key="group.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>

                                <el-form-item label="Parent Permission">
                                    <el-select v-model="form.parent_permission" clearable filterable value-key="id"
                                               class="w-100">
                                        <el-option v-for="permission in parent_permissions"
                                                   :value="permission"
                                                   :label="permission.name"
                                                   :key="permission.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>

                        <el-row :gutter="10" class="pb-2">
                            <el-card>
                                <template slot="header">
                                    <i class="fas fa-tags"></i> Attach Roles
                                </template>
                                <el-checkbox-group v-model="form.roles">
                                    @foreach ($roles as $role)
                                        <el-checkbox label="{{$role->id}}">{{$role->name}}</el-checkbox>
                                    @endforeach
                                </el-checkbox-group>
                            </el-card>
                        </el-row>

                        <el-form-item class="text-right">
                            <el-button type="primary" @click="submitForm('editForm')" icon="el-icon-check"> Save
                            </el-button>
                            <a href="{{route('permission.index')}}">
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
        let app = new Vue({
            el: '.content',
            data() {
                return {
                    form: {
                        application: null,
                        group: null,
                        parent_permission: null,
                        name: null,
                        title: null,
                        description: null,
                        roles: [],
                    },
                    applications: null,
                    groups: null,
                    parent_permissions: null,
                    rules: {
                        application: {required: true, message: 'Please select application group.'},
                        group: {required: true, message: 'Please select resource group.'},
                        name: {required: true, message: 'Please input name.'},
                        title: {required: true, message: 'Please input title.'},
                    }
                }
            },
            mounted() {

                //get permission details
                axios.get('/api/permission/{{$id}}')
                    .then(res => {
                        let data = res.data;
                        this.form.id = data.id;
                        this.form.name = data.name;
                        this.form.application = data.application;
                        this.form.title = data.title;
                        this.form.group = data.resource_group;
                        this.form.description = data.description;
                        this.form.parent_permission = data.parent_permission;

                        if (data.roles) {
                            $.each(data.roles, (index, data) => {
                                this.form.roles.push(data.id);
                            });
                        }

                        this.applicationChange();
                        this.resourceGroupChange();
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });

                //get all applications
                axios.get('{{route('api.application.index')}}')
                    .then(res => {
                        this.applications = res.data;
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });
            },
            computed: {},
            methods: {
                submitForm(formRefs) {
                    this.$refs[formRefs].validate((valid) => {
                        if (valid) {
                            axios.put('{{route('api.permission.update', $id)}}', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            window.location = '{{route('permission.index')}}'
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
                },

                applicationChange() {
                    this.groups = null;
                    this.parent_permissions = null;

                    if (this.form.application) {
                        axios.get('/api/application/' + this.form.application.id + '/resources')
                            .then(res => {
                                this.groups = res.data;
                            })
                            .catch(err => {
                                new ErrorHandler().handle(err.response);
                            });
                    }
                },

                resourceGroupChange() {
                    this.parent_permissions = null;

                    if (this.form.group) {

                        axios.get('/api/permission/parent-permissions/' + this.form.application.id + '/' + this.form.group.id)
                            .then(res => {
                                this.parent_permissions = res.data;
                            })
                            .catch(err => {
                                new ErrorHandler().handle(err.response);
                            });
                    }
                }
            }
        });
    </script>
@stop
