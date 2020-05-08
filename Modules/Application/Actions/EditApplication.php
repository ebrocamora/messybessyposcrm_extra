<?php

namespace Modules\Application\Actions;

use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;

class EditApplication extends Action
{
    public function authorize()
    {
        return $this->user()->can('edit-application') && config('app.admin_app');
    }

    public function handle(Application $application)
    {
        return $application;
    }

    public function jsonResponse($result, $request)
    {
        return $result;
    }

    public function htmlResponse($result, $request)
    {
        return view('application::edit')->with('id', $result->id);
    }
}
