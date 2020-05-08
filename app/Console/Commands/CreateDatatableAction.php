<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateDatatableAction extends Command
{
    protected $signature = 'module:make-datatable {module}';

    protected $description = 'Create datatable action of module';

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->stub = base_path('app/Console/stubs/datatable-action.stub');
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $module = $this->argument('module');
        $action = "DataTableOf$module";

        $stub = $this->filesystem->get($this->stub);

        $module_path = config('modules.paths.modules');
        $module_path .= "/$module/Actions";
        $file_path = $module_path."/$action.php";

        $template = str_replace(['$MODULE$', '$ACTIONCLASS$', '$MODEL_LOWER_CASE$', '$MODEL$'], [$module, $action, Str::lower($module), $module], $stub);

        $this->filesystem->makeDirectory($module_path, 0777, true, true);
        $this->filesystem->put($file_path, $template);
    }
}
