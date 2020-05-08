<?php

namespace Modules\System\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder as DataTableBuilder;
use Yajra\DataTables\Html\Column;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();

        $this->registerAddActionColumn();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MenuServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('System', 'Config/config.php') => config_path('system.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('System', 'Config/config.php'), 'system'
        );
    }

    public function registerAddActionColumn()
    {
        DataTableBuilder::macro('addActionColumn', function () {
            $attributes = [
                'data' => 'action',
                'name' => 'action',
                'title' => '',
                'render' => null,
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'footer' => '',
                'class' => 'text-center text-nowrap'
            ];

            $attributes = array_merge($attributes, config('datatables-html.action_attributes'));

            $this->collection->push(new Column($attributes));

            return $this;
        });
    }
}
