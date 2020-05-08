@extends('auditlog::layouts.master')

@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Audit Logs</h1>
@stop

@section('content')
    <el-row :gutter="10">
        <el-col :md="24">
            <el-card>
                <template slot="header">
                    <i class="fas fa-eye text-primary"></i> Audits
                </template>

                <el-row :gutter="10">
                    <el-form ref="form-filter">
                        <el-form label-position="right" label-width="80px">
                            {{--Auditable--}}
                            <el-col :md="8">
                                <el-form-item label="Auditable">
                                    <el-input></el-input>
                                </el-form-item>
                            </el-col>

                            {{--User--}}
                            <el-col :md="8">
                                <el-form-item label="User" prop="user">
                                    <el-input></el-input>
                                </el-form-item>
                            </el-col>

                            {{--Event--}}
                            <el-col :md="6">
                                <el-form-item label="Event" prop="event">
                                    <el-input></el-input>
                                </el-form-item>
                            </el-col>

                            {{--Btn Search--}}
                            <el-col :md="2" class="">
                                <el-button type="primary" class="float-right">Search</el-button>
                            </el-col>
                        </el-form>
                    </el-form>
                </el-row>

                <el-row v-if="tableData.length">
                    <el-divider></el-divider>
                    <el-table :data="tableData" header-cell-class-name="bg-primary">
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <el-row :gutter="10">
                                    <p><strong>Url</strong>: @{{ props.row.url }}</p>

                                    {{--Old Values--}}
                                    <el-col :class="{'el-col-md-12': props.row.event === 'updated'}">
                                        <el-card v-if="['updated','deleted'].includes(props.row.event)"
                                                 header="Old Values" class="card-outline card-primary">
                                            <pre>@{{ props.row.old_values | pretty }}</pre>
                                        </el-card>
                                    </el-col>

                                    {{--New Values--}}
                                    <el-col :class="{'el-col-md-12': props.row.event === 'updated'}">
                                        <el-card v-if="['created','updated'].includes(props.row.event)"
                                                 header="New Values" class="card-outline card-primary">
                                            <pre>@{{ props.row.new_values | pretty }}</pre>
                                        </el-card>
                                    </el-col>
                                </el-row>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Event"
                                prop="event">
                            <template slot-scope="scope">
                                <el-tag effect="dark" :class="eventClass(scope)">@{{ scope.row.event }}</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Auditable"
                                prop="auditable_type">
                        </el-table-column>
                        <el-table-column
                                label="ID"
                                prop="auditable_id">
                        </el-table-column>
                        <el-table-column
                                label="IP"
                                prop="ip_address">
                        </el-table-column>

                        <el-table-column
                                label="Datetime"
                                prop="created_at">
                        </el-table-column>
                    </el-table>
                </el-row>
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
                    tableData: []
                }
            },
            mounted() {
                this.getUserLogs();
            },
            methods: {
                getUserLogs() {
                    axios.get('{{route('api.audit.logs.user.get', auth()->user())}}')
                        .then(res => {
                            this.tableData = res.data;
                            console.log(this.tableData);
                        })
                        .catch(err => new ErrorHandler().handle(err.response));
                },
                eventClass(data){
                    if(data.row.event === 'deleted') return 'el-tag--danger';
                    if(data.row.event === 'updated') return 'el-tag--warning';
                }
            },
            filters: {
                pretty: function (value) {
                    return JSON.stringify(JSON.parse(value), null, 2);
                }
            }
        });
    </script>
@stop