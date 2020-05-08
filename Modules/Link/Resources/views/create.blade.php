@extends('link::layouts.master')
@section('content_header')
    <h1><i class="fas fa-link"></i> {{plural(config('link.name'))}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-plus text-primary"></i> Create Link</div>
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
                    permissions: [],
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
                axios.get('{{route('api.application.index')}}')
                    .then(res => {
                        this.applications = res.data;
                    })
                    .catch(err => {
                        new ErrorHandler().handle(err.response);
                    });
            },
            methods: {
                applicationChange() {
                    this.form.parent_link = null;
                    this.form.resource_group = null;
                    this.resource_groups = null;
                    this.parent_links = null;

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
                    this.form.parent_link = null;
                    this.form.permission = null;
                    this.parent_links = null;

                    if (this.form.resource_group) {
                        axios.get('/api/link/parent/' + this.form.application.id)
                            .then(res => {
                                this.parent_links = res.data;
                            })
                            .catch(err => new ErrorHandler().handle(err.response));
                        this.parent_links = this.form.resource_group.links;
                        this.permissions = this.form.resource_group.permissions;
                    }
                },

                submitForm(formName) {
                    this.$refs[formName].validate((valid) => {
                        if (valid) {
                            axios.post('{{route('api.link.store')}}', this.form)
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
