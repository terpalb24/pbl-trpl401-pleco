<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static Trash first(array $attributes = [])
 * @method static Trash whereBetween(string $column, iterable $values)
 * @method static Trash select(mixed $columns = ['*'])
 */
class Trash extends Model
{
    protected $table = 'collected_trash';

    protected $fillable = [
        'trash_id',
        'robot_id',
        'collected_at',
    ];
}
