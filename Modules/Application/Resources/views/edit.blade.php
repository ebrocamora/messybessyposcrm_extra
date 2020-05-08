@extends('application::layouts.master')
@section('content_header')
    <h1><i class="fas fa-list"></i> {{plural(config('application.name'))}}</h1>
@stop
{{-- Extend @section from parent --}}
@section('content')
    <el-row class="pb-2">
        <el-col :md="24">
            <el-card>
                <div slot="header"><i class="el-icon-edit text-primary"></i> Edit Application</div>
                <div>
                    <el-form :model="form" :rules="rules" ref="createForm">
                        <el-row :gutter="10">

                            {{--Name--}}
                            <el-form-item label="Name" prop="name">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>

                            {{--Description--}}
                            <el-form-item label="Description">
                                <el-input v-model="form.description" type="textarea"></el-input>
                            </el-form-item>

                            {{--URL--}}
                            <el-form-item label="URL" prop="url">
                                <el-input v-model="form.url"></el-input>
                            </el-form-item>

                            {{--Icon--}}
                            <el-form-item label="Icon">
                                <el-input v-model="form.icon"></el-input>
                            </el-form-item>

                            <el-form-item class="text-right">
                                <el-button type="primary" @click="submitForm('createForm')" icon="el-icon-check"> Save</el-button>
                                <a href="{{route('application.index')}}">
                                    <el-button type="default" icon="el-icon-close">Cancel</el-button>
                                </a>
                            </el-form-item>
                        </el-row>
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
                        name: null,
                        description: null,
                        url: null,
                        icon: 'fa fa-list'
                    },
                    rules: {
                        name: [
                            {required: true, message: 'Please input application name.'},
                        ],
                        url: {required: true, message: 'Please input url.'}
                    }
                }
            },
            mounted() {
                axios.get('/api/application/{{$id}}/show')
                    .then(res => {
                        this.form = res.data;
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
                            axios.put('{{route('api.application.update', $id)}}', this.form)
                                .then(res => {
                                    swal('Saved!', 'Saved successfully!', 'success')
                                        .then(value => {
                                            window.location = '{{ route('application.index') }}';
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
