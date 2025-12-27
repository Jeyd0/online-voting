<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-gray-900 relative">
    <!-- Background Decoration -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-indigo-50 dark:bg-indigo-900/20 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[30%] rounded-full bg-blue-50 dark:bg-blue-900/20 blur-3xl"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-purple-50 dark:bg-purple-900/20 blur-3xl"></div>
    </div>

    <div class="relative z-10 mb-6">
        {{ $logo }}
    </div>

    <div class="relative z-10 w-full sm:max-w-md px-8 py-8 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100 dark:border-gray-700">
        {{ $slot }}
    </div>
</div>
