<?php

namespace Modules\Link\Actions;

use Lorisleiva\Actions\Action;

class ShowCreateLinkForm extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-link');
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        return view('link::create');
    }
}
