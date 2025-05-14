<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'client_id',
        'service_id',
        'employee_id',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'status' => AppointmentStatus::class,
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
