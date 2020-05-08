<?php

namespace App\Console\Commands;

use Nwidart\Modules\Commands\ModuleMakeCommand;

class GenerateCRUDActionCommand extends ModuleMakeCommand
{
    protected $name = 'generate:module';

    protected $description = 'Generates module scaffolding.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $names = $this->argument('name');
        $this->call('module:make', ['name' => $names, '--force' => true]);

        foreach ($names as $module) {
            //Create Model
            $this->call("module:make-model", ['model' => $module, 'module' => $module]);

            //DataTable
            $this->call("module:make-datatable", ['module' => $module]);
            //$this->call("module:make-action", ['action' => "DataTableOf$module", 'module' => $module]);

            //Show Create Form
            $this->call("module:make-action", ['action' => "ShowCreate{$module}Form", 'module' => $module]);

            //Store Data
            $this->call("module:make-action", ['action' => "StoreNew$module", 'module' => $module]);

            //Detail view page
            $this->call("module:make-action", ['action' => "View$module", 'module' => $module]);

            //Show edit form
            $this->call("module:make-action", ['action' => "ShowEdit{$module}Form", 'module' => $module]);

            //Update data
            $this->call("module:make-action", ['action' => "Update$module", 'module' => $module]);


            //Delete data
            $this->call("module:make-action", ['action' => "Delete$module", 'module' => $module]);


            //Find data
            $this->call("module:make-action", ['action' => "Find$module", 'module' => $module]);
        }
    }

}
