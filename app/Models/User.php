<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'fa_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function currentEmployment()
    {
        return $this->employments()->latest()->first();
    }

    public function currentRole()
    {
        return optional($this->currentEmployment())->role;
    }

    public function isStudent()
    {
        return optional($this->currentRole())->name === 'student';
    }

    public function isProfessor()
    {
        return optional($this->currentRole())->name === 'professor';
    }

    public function semesterEnrollments()
    {
        return $this->hasMany(SemesterEnrollment::class, 'student_id');
    }

    public function coursesTaught()
    {
        return $this->hasMany(Course::class, 'professor_id');
    }
}
