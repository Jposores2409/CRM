<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'email', 'telefono', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}