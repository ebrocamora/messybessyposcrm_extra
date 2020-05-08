<?php


namespace Modules\User\Actions;


use Lorisleiva\Actions\Action;
use Modules\User\Entities\User;

class SetUserRole extends Action
{
    public function authorize()
    {
        return $this->user()->can('assign-user-roles');
    }

    public function handle(User $user)
    {
        $user->roles()->sync($this->roles);
        $user->forgetCachedPermissions();

        return $user;
    }
}
