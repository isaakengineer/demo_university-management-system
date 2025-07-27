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
        return $this->belongsToMany(Role::class, 'employments', 'user_id', 'role_id')
            ->latest('employments.created_at')  // Explizit die Tabelle angeben
            ->first();
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'employments', 'user_id', 'role_id')
    //         ->withPivot('department_id') // Falls zusätzliche Felder vorhanden sind
    //         ->withTimestamps(); // Falls Timestamps verwendet werden
    // }

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

    public function getCurrentDepartmentAttribute()
    {
        if ($this->isStudent()) {
            // Get the latest semester enrollment for the student
            $latestEnrollment = $this->semesterEnrollments()->latest()->first();
            if ($latestEnrollment) {
                // Get the first course enrollment for the latest semester
                $courseEnrollment = $latestEnrollment->courseEnrollments()->first();
                if ($courseEnrollment) {
                    return $courseEnrollment->course->department;
                }
            }
        } elseif ($this->employments()->exists()) {
            // Get the latest employment
            $latestEmployment = $this->employments()->latest()->first();
            if ($latestEmployment) {
                return $latestEmployment->department;
            }
        }

        return null;
    }
    public static function findByRoleAndDepartment($roleId, $departmentId)
    {
        return self::whereHas('employments', function ($q) use ($roleId, $departmentId) {
            $q->where('role_id', $roleId)
              ->where('department_id', $departmentId);
        })->get();
    }
    public static function findByRole($roleId)
    {
        return self::whereHas('employments', function ($q) use ($roleId) {
            $q->where('role_id', $roleId);
        })->get();
    }
}
