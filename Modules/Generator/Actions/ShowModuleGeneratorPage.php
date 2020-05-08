<?php


namespace Modules\Generator\Actions;


use Lorisleiva\Actions\Action;

class ShowModuleGeneratorPage extends Action
{
    public function authorize()
    {
        return $this->user()->can('generate-module');
    }

    public function handle()
    {
        return view('generator::index');
    }
}