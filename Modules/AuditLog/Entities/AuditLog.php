<?php

namespace Modules\AuditLog\Entities;

use Modules\System\Entities\Model;
use Modules\User\Entities\User;

class AuditLog extends Model
{
    //protected $connection = '';
    protected $table = 'audits';
    protected $fillable = [];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
