<?php

namespace Modules\Role\Actions;

use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;

class FindRole extends Action
{
    public function handle($role)
    {
        return Role::with('permissions')->find($role);
    }
}
