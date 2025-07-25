<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fa_name',
        'fa_description',
    ];

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
