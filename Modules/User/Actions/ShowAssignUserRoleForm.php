<?php


namespace Modules\User\Actions;


use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;
use Modules\User\Entities\User;

class ShowAssignUserRoleForm extends Action
{
    public function authorize()
    {
        return $this->user()->can('assign-user-roles');
    }

    public function handle($user)
    {
        $user = User::with('roles')->find($user);
        $roles = Role::orderBy('name')->get();

        return view('user::assign-user-roles', compact(['user', 'roles']));
    }
}
