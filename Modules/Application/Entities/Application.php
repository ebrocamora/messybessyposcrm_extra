<?php

namespace Modules\Application\Entities;

use Modules\ResourceGroup\Entities\ResourceGroup;
use Modules\System\Entities\Model;

class Application extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [];

    public function resource_groups()
    {
        return $this->hasMany(ResourceGroup::class)->orderBy('name');
    }
}
