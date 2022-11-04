<?php

namespace App\Models;

use App\Notifications\Admin\AccountConfirmation;
use ESolution\DBEncryption\Traits\EncryptedAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Log;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, EncryptedAttribute, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be encrypted/decrypted.
     *
     * @var array
     */
    protected $encryptable = [
        'name',
        'email',
    ];

    /**
     * Ruoli degli utenti
     */
    public static $roles = [
        'admin' => 'Amministratore',
        'user' => 'Utente',
    ];

    /**
     * Ritorna il nome del ruolo dell'utente
     * admin -> Amministratore
     * user -> Utente
     */
    public function roleName()
    {
        return self::$roles[$this->getRoleNames()->first()];
    }

    /**
     * Azioni database
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            Log::info('User creating');
        });

        self::created(function ($model) {
            Log::info('User created');

            if (config('custom.send_created_user_notification') == true) {
                try {
                    Log::info('Sending account confirmation email ...');
                    $model->notify(new AccountConfirmation($model));
                } catch (Exception $e) {
                    Log::info($e->getMessage());
                }
            }
        });

        self::updating(function ($model) {
            Log::info('User updating');
        });

        self::updated(function ($model) {
            Log::info('User updated');
        });

        self::deleting(function ($model) {
            Log::info('User deleting');
        });

        self::deleted(function ($model) {
            Log::info('User deleted');
        });
    }
}
