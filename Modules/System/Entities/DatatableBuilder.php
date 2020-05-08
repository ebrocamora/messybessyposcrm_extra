<?php


namespace Modules\System\Entities;


use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class DatatableBuilder extends Builder
{
    public function __construct(Repository $config, Factory $view, HtmlBuilder $html)
    {
        $this->processing(true);
        $this->dom(config('datatables-html.dom'));
        $this->buttons(config('datatables-html.buttons'));
        $this->stateSave(true);
        $this->stateDuration(180);
        $this->responsive(true);
        $this->pageLength(25);

        parent::__construct($config, $view, $html);
    }

    public function buttons(...$buttons)
    {
        $this->attributes['buttons'] = [];

        foreach ($buttons as $button) {
            $this->attributes['buttons'][] = $button instanceof Arrayable ? $button->toArray() : $button;
        }

        return $this;
    }

    public function addCheckbox(array $attributes = [], $position = false)
    {
        $attributes = array_merge([
            'defaultContent' => '<input id="id" type="checkbox" ' . $this->html->attributes($attributes) . '/>',
            'title' => '<div class="icheck-warning"><input type="checkbox" ' . $this->html->attributes($attributes + ['id' => 'dataTablesCheckbox']) . '/><label for="dataTablesCheckbox"></label></div>',
            'data' => 'checkbox',
            'name' => 'checkbox',
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => false,
            'width' => '10px',
        ], $attributes);

        $column = new Column($attributes);

        if ($position === true) {
            $this->collection->prepend($column);
        } elseif ($position === false || $position >= $this->collection->count()) {
            $this->collection->push($column);
        } else {
            $this->collection->splice($position, 0, [$column]);
        }

        return $this;
    }
}