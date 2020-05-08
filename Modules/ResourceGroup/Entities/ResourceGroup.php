<?php

namespace Modules\ResourceGroup\Entities;

use Modules\Application\Entities\Application;
use Modules\Permission\Entities\Permission;
use Modules\System\Entities\Model;

class ResourceGroup extends Model
{
    //protected $connection = '';
    //protected $table = '';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function parent_permissions()
    {
        return $this->hasMany(Permission::class)->where('parent_permission_id', null);
    }
}
