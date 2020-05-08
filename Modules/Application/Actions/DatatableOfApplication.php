<?php

namespace Modules\Application\Actions;

use Lorisleiva\Actions\Action;
use Modules\Application\Entities\Application;
use Modules\System\Entities\DatatableBuilder;

class DatatableOfApplication extends Action
{
    public function authorize()
    {
        return $this->user()->can('view-any-application') && config('app.admin_app');
    }

    public function handle(DatatableBuilder $builder)
    {
        if (request()->ajax()) {
            return datatables()->of(Application::query())
                ->editColumn('action', function ($application) {
                    return view('application::components.actions', compact(['application']));
                })->editColumn('url', function($application){
                    return "<a target='_blank' href='{$application->url}'>{$application->url}</a>";
                })
                ->toJson();
        }

        $builder->addColumn(['data' => 'name']);
        $builder->addColumn(['data' => 'description']);
        $builder->addColumn(['data' => 'icon']);
        $builder->addColumn(['data' => 'url']);


        $builder->addActionColumn();
        $builder->setTableId('applications');

        return view('application::index', compact('builder'));
    }
}
