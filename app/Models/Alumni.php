<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni'; // Explicitly set the table name
    
    protected $fillable = ['user_id', 'current_employer', 'job_title', 'employment_status'];

    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'user_id'); // Explicitly specify foreign key
    }
}