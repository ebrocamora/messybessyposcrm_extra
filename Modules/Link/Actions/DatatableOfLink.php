<?php

namespace Modules\Link\Actions;

use Lorisleiva\Actions\Action;
use Modules\Link\Entities\Link;
use Modules\System\Entities\DatatableBuilder;

class DatatableOfLink extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('view-any-link');
    }

    public function handle(DatatableBuilder $html)
    {
        if (request()->ajax()) {
            return datatables()->eloquent(Link::with(['resource_group.application', 'permission']))
                ->addColumn('application', function ($link) {
                    return $link->resource_group->application->name;
                })
                ->editColumn('title', function ($link) {
                    $path = $link->resource_group->application->url . $link->url;
                    return "<a target='_blank' href='{$path}'>{$link->title}</a>";
                })
                ->addColumn('permission', function ($link) {
                    return $link->permission->name ?? '';
                })
                ->editColumn('action', function ($link) {
                    return view('link::components.actions', compact('link'));
                })
                ->rawColumns(['action', 'title'])
                ->toJson();
        }

        $html->addColumn(['data' => 'application']);
        $html->addColumn(['data' => 'title']);
        $html->addColumn(['data' => 'permission']);
        $html->addColumn(['data' => 'status']);
        $html->addActionColumn();
        $html->setTableId('links');

        return view('link::index', compact('html'));
    }
}
