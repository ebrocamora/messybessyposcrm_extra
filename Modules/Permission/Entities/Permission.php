<?php

namespace Modules\Permission\Entities;

use Modules\Application\Entities\Application;
use Modules\ResourceGroup\Entities\ResourceGroup;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    //protected $connection = '';
    //protected $table = '';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function resource_group()
    {
        return $this->belongsTo(ResourceGroup::class);
    }

    public function parent_permission()
    {
        return $this->belongsTo(Permission::class, 'parent_permission_id');
    }

    public function parent_members()
    {
        return $this->hasMany(Permission::class, 'parent_permission_id', 'id');
    }

    public function scopeParentPermissions($query)
    {
        return $query->where('parent_permission_id', null);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 'Yes');
    }
}
