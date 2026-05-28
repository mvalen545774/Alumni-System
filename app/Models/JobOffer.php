<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $fillable = ['user_id', 'job_title', 'company', 'location', 'description', 'contact_email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}