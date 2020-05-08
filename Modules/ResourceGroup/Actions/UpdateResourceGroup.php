<?php

namespace Modules\ResourceGroup\Actions;

use Lorisleiva\Actions\Action;
use Modules\ResourceGroup\Entities\ResourceGroup;

class UpdateResourceGroup extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update-resource-group');
    }

    /**
     * Get the validation rules that apply to the action.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'application' => 'required',
            'name' => 'required|unique:resource_groups,name,' . $this->id . ',id,application_id,' . $this->application['id'],
            'icon' => 'required'
        ];
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle(ResourceGroup $resourcegroup)
    {
        $resourcegroup->application_id = $this->application['id'];
        $resourcegroup->name = $this->name;
        $resourcegroup->description = $this->description;
        $resourcegroup->icon = $this->icon;
        $resourcegroup->save();

        return $resourcegroup;
    }
}
