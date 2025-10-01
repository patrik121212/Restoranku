<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role_name', 'description', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
