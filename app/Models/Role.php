<?php

namespace App\Models;

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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_has_roles');
    }
}
