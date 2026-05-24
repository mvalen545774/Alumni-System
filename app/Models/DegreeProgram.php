<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreeProgram extends Model
{
    protected $fillable = ['program_code', 'program_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}