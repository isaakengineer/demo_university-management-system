<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('پنل مدیریت') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- کارتابل ایجاد درخواست‌ها -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">ایجاد درخواست جدید</h3>
                        <p class="mb-4">از این بخش می‌توانید درخواست‌های جدید را ثبت کنید.</p>
                        <a href="{{ route('workflow.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            رفتن به بخش درخواست‌ها
                        </a>
                    </div>
                </div>

                <!-- کارتابل مشاهده تاییدیه‌ها -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">مشاهده تاییدیه‌ها</h3>
                        <p class="mb-4">از این بخش می‌توانید درخواست‌های ارسالی و وضعیت تایید آن‌ها را مشاهده کنید.</p>
                        <a href="{{ route('approval.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            رفتن به بخش تاییدیه‌ها
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
