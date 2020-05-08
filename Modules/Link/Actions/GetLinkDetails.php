<?php

namespace Modules\Link\Actions;

use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;

class GetLinkDetails extends Action
{
    public function handle()
    {
        return Link::with(['resource_group.application', 'resource_group.permissions', 'permission'])->find($this->link);
    }
}
