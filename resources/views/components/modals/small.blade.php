<div x-show="showModal" class="modal-base"
    x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    x-cloak>
    <!-- Modal -->
    <div {{ $attributes->merge(['class' => 'modal-content']) }}
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
