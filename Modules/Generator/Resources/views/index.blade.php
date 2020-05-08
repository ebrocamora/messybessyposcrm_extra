@extends('generator::layouts.master')
@section('content_header')
    <h1>Module Generator</h1>
@stop
@section('content')
    <el-row :gutter="10">
        <el-col :span="24">
            <el-card>
                <template slot="header">
                    <i class="el-icon-plus text-primary"></i> New Module
                </template>

                <el-form>
                    <el-col :md="12">
                        <el-form-item label="Name" prop="name">
                            <el-input></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :md="12">
                        <el-form-item label="Table Name" prop="table_name">
                            <el-input></el-input>
                        </el-form-item>
                    </el-col>

                    <div class="text-right">
                        <el-button type="primary" icon="el-icon-refresh">Generate</el-button>
                    </div>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
@stop
@section('js')
    <script>
        new Vue({
            el: '.content'
        });
    </script>
@stop