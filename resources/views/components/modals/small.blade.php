<div x-show="showModal" class="fixed flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0"  
    x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    x-cloak>
    <!-- Modal -->
    <div {{ $attributes->merge(['class' => 'bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-200 rounded-xl shadow-2xl p-3 w-full md:max-w-lg mx-2 md:p-6 md:mx-5 max-h-screen overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600']) }} 
        x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
        <!-- Title -->
        <div class="font-bold block text-lg mb-3">
            {{ $title }}
        </div>
        <!-- Slot -->
        <div class="flex flex-col space-y-2">
            {{ $slot }}
        </div>
        <!-- Acttion -->
        <div class="flex items-center justify-between space-x-5 mt-5">
            {{ $action }}
        </div>
    </div>
</div>