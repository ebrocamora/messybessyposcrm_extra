<?php


namespace Modules\Role\Actions;


use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;

class AllApplicationResourcePermissions extends Action
{
    public function handle()
    {
        return Application::with(['resource_groups.parent_permissions.parent_members'])->get();
    }
}
