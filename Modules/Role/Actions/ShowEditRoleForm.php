<?php

namespace Modules\Role\Actions;

use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;

class ShowEditRoleForm extends Action
{
    public function authorize()
    {
        return $this->user()->can('edit-role');
    }

    public function handle($role)
    {
        $permissions = (new AllApplicationResourcePermissions())->run();
        return view('role::edit', compact(['permissions']))->with('id', $role);
    }
}
