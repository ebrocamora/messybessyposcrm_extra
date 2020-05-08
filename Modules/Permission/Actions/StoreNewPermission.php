<?php

namespace Modules\Permission\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;

class StoreNewPermission extends Action
{
    public function authorize()
    {
        return $this->user()->can('create-permission');
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:permissions',
            'title' => 'required',
            'application' => 'required',
            'group' => 'required'
        ];
    }

    public function handle()
    {
        $permission = new Permission();
        $permission->id = Str::orderedUuid()->toString();
        $permission->application_id = $this->application['id'];
        $permission->resource_group_id = $this->group['id'];
        $permission->parent_permission_id = $this->parent_permission['id'];
        $permission->name = $this->name;
        $permission->title = $this->title;
        $permission->description = $this->description;
        $permission->guard_name = 'web';
        $permission->save();

        $permission->roles()->attach($this->roles);
        $permission->forgetCachedPermissions();

        return $permission;
    }
}
