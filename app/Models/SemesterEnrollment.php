<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'year',
        'semester',
        'credits',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function courseEnrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'enrollment_id');
    }
}
