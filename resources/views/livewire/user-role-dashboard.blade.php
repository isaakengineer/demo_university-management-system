<div>
    <!-- نمایش کاربران بر اساس نقش -->
    @foreach ($usersByRole as $role => $users)
        <div class="mb-8">
            <h3 class="text-lg font-bold mb-2">{{ ucfirst($role) }}</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">شناسه</th>
                        <th class="p-2">نام</th>
                        <th class="p-2">ایمیل</th>
                        <th class="p-2">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="p-2">{{ $user->id }}</td>
                            <td class="p-2">{{ $user->fa_name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">
                                <button
                                    wire:click="loginAsUser({{ $user->id }})"
                                    class="bg-blue-500 text-white px-3 py-1 rounded"
                                >
                                    ورود به عنوان {{ $user->fa_name }}
                                </button>

                                <button
                                    wire:click="toggleDetails({{ $user->id }})"
                                    class="bg-green-500 text-white px-3 py-1 rounded mt-2"
                                >
                                    {{ $showDetails[$user->id] ?? false ? 'مخفی کردن جزئیات' : 'نمایش جزئیات' }}
                                </button>


                            </td>
                        </tr>
                        @if (($showDetails[$user->id] ?? false))
                            <tr>
                                <td colspan="3" class="p-4 bg-gray-50">
                                    @if ($studentDetails)
                                        <div class="mt-4">
                                            <h3 class="text-lg font-bold mb-2">ترم‌های ثبت‌نام شده (دانشجو)</h3>
                                            @foreach ($studentDetails as $semester)
                                                <div class="mb-4">
                                                    <h4 class="font-medium">{{ $semester->year }} - ترم {{ $semester->semester }}</h4>
                                                    <ul class="ml-4">
                                                        @foreach ($semester->courseEnrollments as $enrollment)
                                                            <li>{{ $enrollment->course->name }} (نمره: {{ $enrollment->grade ?? 'ندارد' }})</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if ($professorDetails)
                                        <div class="mt-4">
                                            <h3 class="text-lg font-bold mb-2">دروس ارائه شده (استاد)</h3>
                                            <ul>
                                                @foreach ($professorDetails as $course)
                                                    <li>{{ $course->name }} ({{ $course->credits }} واحد)</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
