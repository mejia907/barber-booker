<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialty_id',
        'biography',
        'image',
    ];

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'employee_service');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
