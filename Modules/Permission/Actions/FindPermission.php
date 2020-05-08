<?php

namespace Modules\Permission\Actions;

use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;

class FindPermission extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('view-permission');
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        return Permission::with('application', 'resource_group', 'parent_permission', 'roles')->where('id', $this->permission)->first();
    }
}
