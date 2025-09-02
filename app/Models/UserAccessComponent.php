<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessComponent extends Model
{
    use HasFactory;
    protected $fillable=[
        'components_id',
        'users_id',
        'access',
        'permissions'
    ];
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
