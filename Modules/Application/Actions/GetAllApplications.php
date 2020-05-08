<?php

namespace Modules\Application\Actions;

use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;

class GetAllApplications extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('view-any-application') && config('app.admin_app');
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        return Application::orderBy('name')->get();
    }
}
