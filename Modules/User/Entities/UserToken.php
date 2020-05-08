<?php

namespace Modules\User\Entities;


use Illuminate\Support\Str;
use Modules\System\Entities\Model;

class UserToken extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $dates = ['expired_at', 'created_at', 'updated_at'];

    protected $fillable = ['user_id', 'token', 'refresh_token', 'revoked', 'expired_at'];
    protected $casts = [
        'revoked' => 'bool'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::orderedUuid()->toString();
        });
    }

    public function scopeOfToken($query, $token)
    {
        $query->where('token', $token);
    }
}
