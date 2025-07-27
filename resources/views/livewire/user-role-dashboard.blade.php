<div>
    <!-- Nutzer nach Rollen gruppiert anzeigen -->
    @foreach ($usersByRole as $role => $users)
        <div class="mb-8">
            <h3 class="text-lg font-bold mb-2">{{ ucfirst($role) }}</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Name</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">
                                <button
                                    wire:click="loginAsUser({{ $user->id }})"
                                    class="bg-blue-500 text-white px-3 py-1 rounded"
                                >
                                    Als {{ $user->name }} anmelden
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <!-- Rollenspezifische Details -->
    @if ($studentDetails)
        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Eingeschriebene Semester (Student)</h3>
            @foreach ($studentDetails as $semester)
                <div class="mb-4">
                    <h4 class="font-medium">{{ $semester->year }} - Semester {{ $semester->semester }}</h4>
                    <ul class="ml-4">
                        @foreach ($semester->courseEnrollments as $enrollment)
                            <li>{{ $enrollment->course->name }} (Note: {{ $enrollment->grade ?? 'N/A' }})</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif

    @if ($professorDetails)
        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Angebotene Kurse (Professor)</h3>
            <ul>
                @foreach ($professorDetails as $course)
                    <li>{{ $course->name }} ({{ $course->credits }} Credits)</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
