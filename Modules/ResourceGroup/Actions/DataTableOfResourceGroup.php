<?php

namespace Modules\ResourceGroup\Actions;

use Lorisleiva\Actions\Action;
use Modules\ResourceGroup\Entities\ResourceGroup;
use Modules\System\Entities\DatatableBuilder;

class DataTableOfResourceGroup extends Action
{

    public function authorize()
    {
        return $this->user()->can('view-any-resource-group');
    }

    /**
     * Execute the action and return a result.
     *
     * @param DatatableBuilder $builder
     * @return mixed
     * @throws \Exception
     */
    public function handle(DatatableBuilder $builder)
    {
        if (request()->ajax()) {
            return datatables()->of(ResourceGroup::with('application')->get())
                ->editColumn('action', function ($resourcegroup) {
                    return view('resourcegroup::components.actions', compact(['resourcegroup']));
                })
                ->toJson();
        }

        $builder->addColumn(['data' => 'application.name', 'title' => 'Application']);
        $builder->addColumn(['data' => 'name']);
        $builder->addColumn(['data' => 'description']);
        $builder->addColumn(['data' => 'icon']);
        $builder->addActionColumn();
        $builder->setTableId('resourcegroups');

        return view('resourcegroup::index', compact('builder'));
    }
}
