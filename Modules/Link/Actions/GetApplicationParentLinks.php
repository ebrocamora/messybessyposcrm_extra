<?php

namespace Modules\Link\Actions;

use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;

class GetApplicationParentLinks extends Action
{
    public function rules()
    {
        return [
            'application'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'application.required'=>'Required parameter to get parent links is missing.'
        ];
    }

    public function handle()
    {
        return Link::where([
            'parent_link_id' => null,
            'status' => 'On'
        ])->where('application_id', $this->application)->orderBy('title')
            ->get();
    }
}
