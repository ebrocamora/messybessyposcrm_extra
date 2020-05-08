@extends('role::layouts.master')
@section('content_header')
    <h1><i class="fas fa-user-tag"></i> {{plural(config('role.name'))}}</h1>
@stop
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-edit text-primary"></i> Edit Role</div>
                <div>
                    <el-form @submit.native.prevent :model="form" :rules="rules" ref="editForm">
                        <el-form-item label="Name" prop="name">
                            <el-input v-model="form.name"></el-input>
                        </el-form-item>

                        <el-form-item label="Description" prop="description">
                            <el-input type="textarea" v-model="form.description"></el-input>
                        </el-form-item>

                        <el-row class="mb-3">
                            <el-card header="Attach Permissions">
                                <el-collapse v-model="application_accordion" accordion>
                                    @foreach($permissions as $index=>$application)
                                        <el-collapse-item title="{{$application->name}}" name="{{$application->id}}">
                                            <template slot="title"><span
                                                    class="text-primary font-weight-bolder">{{$application->name}}</span>
                                            </template>
                                            <el-collapse v-model="group_accordion" accordion>
                                                @foreach ($application->resource_groups as $group_index=>$group)
                                                    <el-collapse-item name="{{$group->id}}">
                                                        <template slot="title">
                                                            <span class="text-primary"><i
                                                                    class="fas fa-hand-point-right"></i>
                                                            {{$group->name}}
                                                            </span></template>
                                                        <el-row :gutter="10">
                                                            @foreach ($group->parent_permissions as $parent_permission)
                                                                <el-col :md="8" class="pb-1">
                                                                    <el-card>
                                                                        <div class="text item">
                                                                            <el-checkbox v-model="form.permissions"
                                                                                         label="{{ $parent_permission->id }}">{{ $parent_permission->title }}</el-checkbox>
                                                                        </div>
                                                                        @if ($parent_permission->parent_members)

                                                                            <el-checkbox-group
                                                                                v-model="form.permissions">
                                                                                @foreach ($parent_permission->parent_members as $member)
                                                                                    <div class="text item">
                                                                                        <el-checkbox
                                                                                            label="{{$member->id}}">{{$member->title}}</el-checkbox>
                                                                                    </div>
                                                                                @endforeach
                                                                            </el-checkbox-group>
                                                                        @endif
                                                                    </el-card>
                                                                </el-col>
                                                            @endforeach
                                                        </el-row>
                                                    </el-collapse-item>
                                                @endforeach
                                            </el-collapse>
                                        </el-collapse-item>
                                        {{--<el-divider><i class="el-icon-star-on"></i></el-divider>--}}
                                    @endforeach
                                </el-collapse>
                            </el-card>
                        </el-row>

                        <el-form-item class="text-right">
                            <el-button type="primary" @click="submitForm('editForm')" icon="el-icon-check"> Save</el-button>
                            <a href="{{route('role.index')}}">
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
                        name: '',
                        description: '',
                        permissions: [],
                    },
                    application_accordion: null,
                    group_accordion: null,
                    rules: {
                        name: {required: true, message: 'Please input name.'}
                    }
                }
            },
            mounted() {
                axios.get('{{route('api.role.find', $id)}}')
                    .then(res => {
                        this.form.name = res.data.name;
                        this.form.description = res.data.description;
                        if(res.data.permissions){
                            $.each(res.data.permissions, (index, data)=>{
                                this.form.permissions.push(data.id);
                            });
                        }
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
                            axios.put('{{route('api.role.update', $id)}}', this.form)
                                .then(res => {
                                    swal('Success', 'Saved successfully!', 'success')
                                        .then(() => {
                                            window.location = '{{route('role.index')}}'
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
