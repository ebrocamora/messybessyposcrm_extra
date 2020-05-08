@extends('link::layouts.master')

@section('content_header')
    <h1><i class="fas fa-link"></i> {{plural(config('link.name'))}}</h1>
@stop

@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-edit text-primary"></i> Edit Link</div>
                @include('link::components.form')
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
                        id: null,
                        title: null,
                        application: null,
                        resource_group: null,
                        parent_link: null,
                        permission: null,
                        description: null,
                        url: null,
                        icon: 'fa fa-list',
                        active_pattern: null,
                        order: 0

                    },
                    applications: null,
                    resource_groups: null,
                    parent_links: null,
                    permissions: null,
                    dialogCreatePermissionVisible: false,

                    rules: {
                        application: [{required: true, message: 'Please select application group.'}],
                        resource_group: [{required: true, message: 'Please select resource group.'}],
                        title: [{required: true, message: 'Please input title.'}],
                        url: [{required: true, message: 'Please input url.'}],
                        active_pattern: [{required: true, message: 'Please input active pattern.'}],
                        icon: [{required: true, message: 'Please input icon.'}],
                        order: [{required: true, message: 'Please input order.'}],
                    }
                }
            },
            mounted() {

                //load applications
                axios.get('{{route('api.application.index')}}')
                    .then(res => {
                        this.applications = res.data;
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });

                //get link data
                axios.get('/api/link/{{$id}}/show')
                    .then(res => {
                        let data = res.data;
                        this.form.id = data.id;
                        this.form.title = data.title;
                        this.form.application = data.resource_group.application;
                        this.applicationChange();
                        this.form.resource_group = data.resource_group;
                        this.resourceGroupChange();
                        this.form.parent_link = data.parent_link;
                        this.form.permission = data.permission;
                        this.form.description = data.description;
                        this.form.url = data.url;
                        this.form.icon = data.icon;
                        this.form.active_pattern = data.active_pattern;
                        this.form.order = data.order;
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });
            },
            methods: {
                applicationChange() {
                    this.resetReferences();

                    if (this.form.application) {

                        axios.get('/api/application/' + this.form.application.id + '/resources')
                            .then(res => {
                                this.resource_groups = res.data;
                            })
                            .catch(err => {
                                new ErrorHandler().handle(err.response);
                            });
                    }
                },

                resourceGroupChange() {
                    this.parent_links = null;
                    this.permissions = null;
                    this.form.parent_link = null;
                    this.form.permission = null;

                    if (this.form.resource_group) {
                        axios.get('/api/link/parent/' + this.form.application.id)
                            .then(res => {
                                this.parent_links = res.data;
                            })
                            .catch(err => new ErrorHandler().handle(err.response));
                        this.permissions = this.form.resource_group.permissions;
                    }
                },

                resetReferences() {
                    this.resource_groups = null;
                    this.parent_links = null;
                    this.permissions = null;

                    this.form.resource_group = null;
                    this.form.parent_link = null;
                    this.form.permission = null;
                },

                submitForm(formName) {
                    this.$refs[formName].validate((valid) => {
                        if (valid) {
                            axios.put('{{route('api.link.update', $id)}}', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            window.location = '{{route('link.index')}}'
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
                permissionCreated(data) {
                    this.permissions.push(data);
                    this.form.permission = data;
                    this.dialogCreatePermissionVisible = false;
                }
            },
        });
    </script>
@stop
