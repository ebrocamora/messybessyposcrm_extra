<?php

namespace Modules\Application\Actions;

use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;

class DeleteApplication extends Action
{
    public function authorize()
    {
        return $this->user()->can('delete-application') && config('app.admin_app');
    }

    public function handle(Application $application)
    {
        $application->delete();
        return $application;
    }

    public function jsonResponse($result, $request)
    {
        return $result;
    }

    public function htmlResponse($result, $request)
    {
        return redirect()->back();
    }
}
