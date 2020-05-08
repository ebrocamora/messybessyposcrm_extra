<?php


namespace Modules\Role\Actions;


use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;

class GetAllRoles extends Action
{
    public function handle()
    {
        $roles = Role::orderBy('name')->get();
        if(isset($this->with)){
            $relations = explode(',', $this->with);

            $roles->load($relations);
        }

        return $roles;
    }
}
