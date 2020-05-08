<el-form :model="form" :rules="rules" ref="link_form" label-position="top">
    <el-row :gutter="10">
        {{--Title--}}
        <el-col :md="12">
            <el-form-item label="Title" prop="title">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
        </el-col>

        {{--Icon--}}
        <el-col :md="12">
            <el-form-item label="Icon" prop="icon">
                <el-input v-model="form.icon" placeholder="fa fa-list"></el-input>
            </el-form-item>
        </el-col>

        {{--Application--}}
        <el-col :md="12">
            <el-form-item label="Application" prop="application">
                <el-select v-model="form.application" value-key="id" clearable filterable class="w-100"
                           @change="applicationChange">
                    <el-option v-for="item in applications"
                               :value="item"
                               :label="item.name"
                               :key="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-col>

        {{--Service Group--}}
        <el-col :md="12">
            <el-form-item label="Resource Group" prop="resource_group">
                <el-select v-model="form.resource_group" value-key="id" clearable filterable class="w-100"
                           @change="resourceGroupChange">
                    <el-option v-for="item in resource_groups"
                               :value="item"
                               :label="item.name"
                               :key="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-col>

        {{--Parent Link--}}
        <el-col :md="12">
            <el-form-item label="Parent Link">
                <el-select v-model="form.parent_link" value-key="id" clearable filterable class="w-100">
                    <el-option v-for="item in parent_links"
                               :value="item"
                               :label="item.title"
                               :key="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-col>

        {{--Permission--}}
        <el-col :md="12">
            <el-form-item label="Permission">
                <el-col :span="20">
                    <el-select v-model="form.permission" value-key="id" placeholder="Allowed All" clearable filterable
                               class="w-100">
                        <el-option v-for="item in permissions"
                                   :value="item"
                                   :label="item.name"
                                   :key="item.id"
                        >
                        </el-option>
                    </el-select>
                </el-col>
                <el-button type="primary" icon="el-icon-plus" circle size="mini"
                           @click="dialogCreatePermissionVisible=true"></el-button>
            </el-form-item>
        </el-col>
    </el-row>

    <el-row :gutter="10">
        {{--Description--}}
        <el-col :md="12">
            <el-form-item label="Description">
                <el-input v-model="form.description" type="textarea"></el-input>
            </el-form-item>
        </el-col>

        {{--URL--}}
        <el-col :md="12">
            <el-form-item label="URL" prop="url">
                <el-input v-model="form.url" placeholder="/link"></el-input>
            </el-form-item>
        </el-col>

    </el-row>

    <el-row :gutter="10">

        {{--Active Pattern--}}
        <el-col :md="12">
            <el-form-item label="Active Pattern" prop="active_pattern">
                <el-input v-model="form.active_pattern"></el-input>
            </el-form-item>
        </el-col>

        {{--Order--}}
        <el-col :md="12">
            <el-form-item label="Order" prop="order">
                <el-input-number v-model="form.order" :min="0" class="w-100"></el-input-number>
            </el-form-item>
        </el-col>
    </el-row>

    <el-form-item class="text-right">
        <el-button type="primary" @click="submitForm('link_form')" icon="el-icon-check"> Save</el-button>
        <a href="{{ route('link.index') }}">
            <el-button type="default" icon="el-icon-close">Cancel</el-button>
        </a>
    </el-form-item>
</el-form>


<el-dialog :visible.sync="dialogCreatePermissionVisible" :close-on-press-escape="false"
           :close-on-click-modal="false" :destroy-on-close="true">
    <template slot="title">
        <i class="el-icon-plus text-primary"></i> Create Permission
    </template>

    <create-permission :attrs="form" modal="true" @cancelled="dialogCreatePermissionVisible = false"
                       @created="permissionCreated"></create-permission>
</el-dialog>
