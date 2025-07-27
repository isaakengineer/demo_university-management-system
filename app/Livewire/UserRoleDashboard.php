<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserRoleDashboard extends Component
{
    public $usersByRole = [];
    public $selectedUserId = null;
    public $studentDetails = null;
    public $professorDetails = null;

    public function mount()
    {
        // Alle User mit ihren Rollen laden
        $users = User::with(['employments.role'])->get();

        // Manuell nach Rollen gruppieren
        foreach ($users as $user) {
            $role = $user->employments->first()?->role;
            $roleName = $role ? $role->name : 'other';

            if (!isset($this->usersByRole[$roleName])) {
                $this->usersByRole[$roleName] = [];
            }
            $this->usersByRole[$roleName][] = $user;
        }
    }

    public function loginAsUser($userId)
    {
        $user = User::with(['employments.role', 'semesterEnrollments.courseEnrollments.course', 'coursesTaught'])
                   ->find($userId);

        Auth::login($user);
        $this->selectedUserId = $userId;

        // Rollenspezifische Daten laden
        $role = $user->employments->first()?->role;

        if ($role && $role->name === 'student') {
            $this->studentDetails = $user->semesterEnrollments;
            $this->professorDetails = null;
        } elseif ($role && $role->name === 'professor') {
            $this->professorDetails = $user->coursesTaught;
            $this->studentDetails = null;
        }
    }

    public function render()
    {
        return view('livewire.user-role-dashboard');
    }
}
