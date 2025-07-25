<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'course_id',
        'grade',
        'credits',
    ];

    public function semesterEnrollment()
    {
        return $this->belongsTo(SemesterEnrollment::class, 'enrollment_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
