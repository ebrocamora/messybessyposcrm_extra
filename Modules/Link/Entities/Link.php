<?php

namespace Modules\Link\Entities;

use Modules\Application\Entities\Application;
use Modules\Permission\Entities\Permission;
use Modules\ResourceGroup\Entities\ResourceGroup;
use Modules\System\Entities\Model;

class Link extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function resource_group()
    {
        return $this->belongsTo(ResourceGroup::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function submenus()
    {
        return $this->hasMany(Link::class, 'parent_link_id')->with('permission');
    }

    public function parent_link()
    {
        return $this->belongsTo(Link::class, 'parent_link_id');
    }
}
