<?php

namespace Modules\Link\Actions;

use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;

class DeleteLink extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete-link');
    }

    public function handle(Link $link)
    {
        return $link->delete();
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
