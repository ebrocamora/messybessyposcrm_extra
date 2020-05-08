<template>
    <el-form :model="form" :rules="rules" ref="createForm">

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
                    <el-checkbox v-for="role in roles" :label="role.id" :key="role.id">{{ role.name }}</el-checkbox>
                </el-checkbox-group>
            </el-card>
        </el-row>

        <el-form-item class="text-right">
            <el-button type="primary" @click="submitForm('createForm')" icon="el-icon-check"> Save
            </el-button>

            <a href="/permission" v-if="!modal">
                <el-button type="default" icon="el-icon-close">Cancel</el-button>
            </a>

            <el-button v-else type="default" icon="el-icon-close" @click="$emit('cancelled')">Cancel</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        props: ['modal', 'attrs'],
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
                applications: [],
                groups: [],
                parent_permissions: [],
                roles: [],
                rules: {
                    application: {required: true, message: 'Please select application group.'},
                    group: {required: true, message: 'Please select resource group.'},
                    name: {required: true, message: 'Please input name.'},
                    title: {required: true, message: 'Please input title.'},
                }
            }
        },
        mounted() {
            //get all applications
            axios.get('/api/application')
                .then(res => {
                    this.applications = res.data;
                })
                .catch(err => {
                    new ErrorHandler().handle(err.response);
                });

            //get all roles
            axios.get('/api/role')
                .then(res => {
                    this.roles = res.data;
                }).catch(err => new ErrorHandler().handle(err.response));

            if(this.modal){
                if(this.attrs){
                    this.form.application = this.attrs.application;
                    this.applicationChange();
                    this.form.group = this.attrs.resource_group;
                    this.resourceGroupChange();
                }
            }
        },
        computed: {},
        methods: {
            submitForm(formRefs) {
                this.$refs[formRefs].validate((valid) => {
                    if (valid) {
                        if (this.form.roles.length > 0) {
                            axios.post('/api/permission', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            if (this.modal) {
                                                this.$emit('created', res.data);
                                            } else {
                                                window.location = '/permission'
                                            }
                                        });
                                })
                                .catch(err => {
                                    new ErrorHandler().handle(err.response);
                                });
                        } else {
                            ElementUI.Notification.error('Please attached this permission to role(s).');
                            return false;
                        }
                    } else {
                        ElementUI.Notification.error('Please input required fields.');
                        return false;
                    }
                });
            },

            applicationChange() {
                this.groups = null;
                this.parent_permissions = null;
                this.form.group = null;

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
    }
</script>

<style scoped>

</style>
