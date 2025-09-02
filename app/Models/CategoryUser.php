<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryUser extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mains():BelongsToMany
    {
        return $this->belongsToMany(Main::class, 'user_roles')
                    ->withTimestamps();
    }

    public function rolesByModule($moduleId)
    {
        return $this->mains()->where('module_id', $moduleId);
    }
}
