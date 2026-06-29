<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @method static Robot first(array $attributes = [])
 */
class Robot extends Authenticatable implements CanResetPassword
{
    protected $table = 'robots';
    protected $primaryKey = 'robot_id';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'robot_name',
        'api_key',
        'location_coordinates'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->robot_id = (string) Str::uuid();
        });
    }
}
