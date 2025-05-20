<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'category_id',
        'image',
        'status'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? Storage::url($this->image)
            : asset('assets/images/default-service.png'); // Imagen por defecto si no hay imagen
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_service');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
