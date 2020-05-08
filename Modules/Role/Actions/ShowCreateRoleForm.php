<?php

namespace Modules\Role\Actions;

use Lorisleiva\Actions\Action;

class ShowCreateRoleForm extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-role');
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = (new AllApplicationResourcePermissions())->run();
        return view('role::create', compact('permissions'));
    }
}
