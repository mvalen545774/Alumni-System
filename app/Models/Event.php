<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'event_date', 'location',
        'event_type', 'venue_type', 'max_attendees', 'contact_email'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot('status', 'created_at')
                    ->withTimestamps();
    }
}