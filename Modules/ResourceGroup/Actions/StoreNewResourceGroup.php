<?php

namespace Modules\ResourceGroup\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Action;
use Modules\ResourceGroup\Entities\ResourceGroup;

class StoreNewResourceGroup extends Action
{

    public function authorize()
    {
        return $this->user()->can('create-resource-group');
    }

    public function rules()
    {
        return [
            'application' => 'required',
            'name' => 'required|unique:resource_groups,name,NULL,id,application_id,'.$this->application['id'],
            'icon' => 'required'
        ];
    }

    public function handle()
    {
        $group = new ResourceGroup();
        $group->id = Str::orderedUuid()->toString();
        $group->application_id = $this->application['id'];
        $group->name = $this->name;
        $group->description = $this->description;
        $group->icon = $this->icon;
        $group->save();

        return $group;
    }
}
