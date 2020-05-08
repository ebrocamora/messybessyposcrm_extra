<?php

namespace Modules\Role\Entities;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    //protected $connection = '';
    //protected $table = '';
    public $incrementing = false;
    protected $keyType = 'string';
}
