<?php

namespace App\Models;

use Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['account_id', 'full_name', 'email', 'password', 'role'])]
#[Hidden(['password'])]
class Account extends Authenticatable
{
    /** @use HasFactory<AccountFactory> */
    use HasFactory, Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
