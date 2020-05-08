<?php


namespace Modules\System\Entities;

use OwenIt\Auditing\Contracts\Auditable;

class Model extends \Illuminate\Database\Eloquent\Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}