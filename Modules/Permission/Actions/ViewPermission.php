<?php

namespace Modules\Permission\Actions;

use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;

class ViewPermission extends Action
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
     * @param Permission $permission
     * @return mixed
     */
    public function handle(Permission $permission)
    {
        return view('permission::view', compact('permission'));
    }
}
