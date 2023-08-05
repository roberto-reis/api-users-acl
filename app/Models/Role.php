<?php

namespace App\Models;

use App\Models\User;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $table = 'roles';
    protected $primaryKey = 'uid';
    protected $keyType = 'string';
    protected $icrementing = false;

    protected $fillable = [
        'name',
        'label'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_has_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_has_roles')->select('name', 'label');
    }
}
