<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UuidTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use UuidTrait;

    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $keyType = 'string';
    protected $icrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone'
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

    protected $appends = ['permissions'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_has_users', 'user_uid', 'role_uid');
    }

    public function permissions(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getPermissions(),
        );
    }

    private function getPermissions()
    {
        return $this->roles->flatMap(function($role) {
            return $role->permissions()->pluck('name')->unique();
        });
    }

    public function hasPermission(string $permission): bool
    {
        return $this->getPermissions()->contains($permission);
    }
}
