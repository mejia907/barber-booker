<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\URL;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'status'
    ];

    protected $cats = [ 'status' => 'boolean' ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function generateBookingLink(): string
    {
        return URL::temporarySingnedRoute('client.book', now()->addMinutes(30), ['client' => $this->id]);
    }
}
