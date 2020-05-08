<?php

namespace Modules\Role\Actions;

use Lorisleiva\Actions\Action;

class ViewRole extends Action
{
    public function authorize()
    {
        return $this->user()->can('view-role');
    }

    public function handle($role)
    {
        return view('role::view')->with('id', $role);
    }
}
