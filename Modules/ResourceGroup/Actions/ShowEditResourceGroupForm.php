<?php

namespace Modules\ResourceGroup\Actions;

use Lorisleiva\Actions\Action;

class ShowEditResourceGroupForm extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit-resource-group');
    }

    public function handle($resourcegroup)
    {
       return view('resourcegroup::edit')->with('id', $resourcegroup);
    }
}
