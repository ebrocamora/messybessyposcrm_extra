<?php


namespace Modules\AuditLog\Actions;


use Lorisleiva\Actions\Action;
use Modules\AuditLog\Entities\AuditLog;

class GetUserAuditLogs extends Action
{
    public function handle()
    {
        return AuditLog::where('user_id', $this->user)->latest()->get();
    }
}