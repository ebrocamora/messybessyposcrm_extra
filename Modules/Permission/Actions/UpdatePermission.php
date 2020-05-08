<?php

namespace Modules\Permission\Actions;

use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;

class UpdatePermission extends Action
{
    public function authorize()
    {
        return $this->user()->can('update-permission');
    }

    public function rules()
    {
        return [
            'name' => 'required|' . Rule::unique('permissions')->ignore($this->id),
            'title' => 'required',
            'application' => 'required',
            'group' => 'required'
        ];
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        $permission = Permission::find($this->id);
        $permission->application_id = $this->application['id'];
        $permission->resource_group_id = $this->group['id'];
        $permission->parent_permission_id = $this->parent_permission['id'];
        $permission->name = $this->name;
        $permission->title = $this->title;
        $permission->description = $this->description;
        $permission->save();

        $permission->roles()->sync($this->roles);
        $permission->forgetCachedPermissions();

        return $permission;
    }
}
