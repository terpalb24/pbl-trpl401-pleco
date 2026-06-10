<?php

namespace App\Models;

use App\Notifications\MailtrapVerifyEmail;
use Database\Factories\AccountFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * @method static Account create(array $attributes = [])
 */
class Account extends Authenticatable implements CanResetPassword
{
    /** @use HasFactory<AccountFactory> */
    use HasFactory, Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->account_id = (string) Str::uuid();
        });
    }

    public function sendPasswordResetNotification($token): void
    {
        // 2. Panggil notifikasi kustom yang kita buat tadi
        $this->notify(new MailtrapVerifyEmail($token));
    }
}
