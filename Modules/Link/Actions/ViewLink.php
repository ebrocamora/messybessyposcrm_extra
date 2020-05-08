<?php


namespace Modules\Link\Actions;


use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;

class ViewLink extends Action
{
    public function authorize()
    {
        return $this->user()->can('view-link');
    }

    public function handle(Link $link)
    {
        return view('link::view', compact('link'));
    }
}
