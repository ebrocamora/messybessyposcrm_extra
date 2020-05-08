<?php

namespace Modules\Role\Actions;

use Lorisleiva\Actions\Action;
use Modules\Role\Entities\Role;
use Modules\System\Entities\DatatableBuilder;

class DataTableOfRole extends Action
{
    public function authorize()
    {
        return $this->user()->can('view-any-role');
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
            return datatables()->of(Role::query())
                ->editColumn('action', function ($role) {
                    return view('role::components.actions', compact(['role']));
                })
                ->toJson();
        }

        $builder->addColumn(['data'=>'name']);
        $builder->addColumn(['data'=>'description']);
        $builder->addActionColumn();
        $builder->setTableId('roles');

        return view('role::index', compact('builder'));
    }
}
