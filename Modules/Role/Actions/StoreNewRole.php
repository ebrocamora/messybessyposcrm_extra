<?php

namespace Modules\Role\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;

class StoreNewRole extends Action
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
     * Get the validation rules that apply to the action.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:roles',
        ];
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        $role = new Role();
        $role->id = Str::orderedUuid()->toString();
        $role->name = $this->name;
        $role->description = $this->description;
        $role->guard_name = 'web';
        $role->save();

        $role->permissions()->attach($this->permissions);;
        $role->forgetCachedPermissions();

        activity()->withProperties($role->permissions)
            ->performedOn($role)
            ->log('Created new role');

        return $role;
    }
}
