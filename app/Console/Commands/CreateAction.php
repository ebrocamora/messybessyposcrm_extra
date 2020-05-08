<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateAction extends Command
{
    var $stub;
    var $filesystem;

    protected $description = "Create module callable options.";

    protected $signature = 'module:make-action {action} {module}';

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->stub = base_path('app/Console/stubs/action.stub');
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $module = $this->argument('module');
        $action = $this->argument('action');

        $stub = $this->filesystem->get($this->stub);

        $module_path = config('modules.paths.modules');
        $module_path .= "/$module/Actions";
        $file_path = $module_path."/$action.php";

        $template = str_replace(['$MODULE$', '$ACTIONCLASS$', '$action$'], [$module, $action, Str::kebab($action)], $stub);

        $this->filesystem->makeDirectory($module_path, 0777, true, true);
        $this->filesystem->put($file_path, $template);
    }
}
