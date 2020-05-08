<?php

namespace Modules\Link\Actions;

use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;

class UpdateLink extends Action
{
    public function authorize()
    {
        return $this->user()->can('edit-link');
    }

    public function rules()
    {
        return [
            'title' => 'required|' . Rule::unique('links')->ignore($this->id),
            'application' => 'required',
            'resource_group' => 'required',
            'url' => 'required',
            'icon' => 'required',
            'active_pattern' => 'required',
            'order' => 'required',
        ];
    }

    public function handle(Link $link)
    {
        $link->application_id = $this->application['id'];
        $link->resource_group_id = $this->resource_group['id'];
        $link->parent_link_id = $this->parent_link['id'] ?? null;
        $link->title = $this->title;
        $link->description = $this->description;
        $link->url = $this->url;
        $link->icon = $this->icon;
        $link->active_pattern = $this->active_pattern;
        $link->order = $this->order;
        $link->permission_id = $this->permission['id'];
        $link->save();

        return $link;
    }
}
