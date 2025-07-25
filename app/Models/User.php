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
        if (!$this->currentEmployment()) {
            return null;
        }
        return $this->currentEmployment()->role()->first();
    }

    public function isStudent()
    {
        $role = $this->currentRole();
        return $role && $role->name === 'student';
    }

    public function isProfessor()
    {
        $role = $this->currentRole();
        return $role && $role->name === 'professor';
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
