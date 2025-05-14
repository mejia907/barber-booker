<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    protected $table = 'specialties';

    protected $fillable = ['name', 'description'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
