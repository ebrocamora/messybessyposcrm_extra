<?php

namespace Modules\ResourceGroup\Actions;

use Lorisleiva\Actions\Action;
use Modules\ResourceGroup\Entities\ResourceGroup;

class DeleteResourceGroup extends Action
{
    public function authorize()
    {
        return $this->user()->can('delete-resource-group');
    }

    public function handle(ResourceGroup $resourcegroup)
    {
        $resourcegroup->delete();

        return $resourcegroup;
    }
}
