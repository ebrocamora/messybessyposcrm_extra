<?php

namespace Modules\Application\Actions;

use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;

class UpdateApplication extends Action
{

    public function authorize()
    {
        return $this->user()->can('edit-application') && config('app.admin_app');
    }

    public function rules()
    {
        return [
            'name' => 'required|' . Rule::unique('applications')->ignore($this->id),
            'url' => 'required'
        ];
    }

    public function handle(Application $application)
    {
        $application->name = $this->name;
        $application->description = $this->description;
        $application->url = $this->url;
        $application->icon = $this->icon;
        $application->save();

        return $application;
    }


}
