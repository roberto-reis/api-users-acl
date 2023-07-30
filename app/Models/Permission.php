<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $table = 'permission';
    protected $primaryKey = 'uid';
    protected $keyType = 'string';
    protected $icrementing = false;
}
