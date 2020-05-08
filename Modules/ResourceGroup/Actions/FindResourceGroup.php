<?php

namespace Modules\ResourceGroup\Actions;

use Lorisleiva\Actions\Action;
use Modules\ResourceGroup\Entities\ResourceGroup;

class FindResourceGroup extends Action
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function handle($resourcegroup)
    {
        return ResourceGroup::with('application')->find($resourcegroup);
    }
}
