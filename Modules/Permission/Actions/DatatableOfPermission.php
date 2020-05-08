<?php

namespace Modules\Permission\Actions;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;
use Modules\System\Entities\DatatableBuilder;

class DataTableOfPermission extends Action
{

    public function authorize()
    {
        return $this->user()->can('view-any-permission');
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
            return datatables()->of(Permission::with(['application'])->get())
                ->editColumn('action', function ($permission) {
                    return view('permission::components.actions', compact(['permission']));
                })
                ->toJson();
        }

        $builder->addColumn(['data' => 'application.name', 'title'=>'Application']);
        $builder->addColumn(['data' => 'name']);
        $builder->addColumn(['data' => 'title']);
        $builder->addColumn(['data' => 'active']);
        $builder->addActionColumn();
        $builder->setTableId('permissions');

        return view('permission::index', compact('builder'));
    }
}
