<?php


namespace Modules\AuditLog\Actions;


use Lorisleiva\Actions\Action;

class IndexPage extends Action
{
    public function authorize()
    {
        return $this->user()->can('access-audit-log') && config('app.admin_app');
    }

    public function handle()
    {
        return view('auditlog::index');
    }
}