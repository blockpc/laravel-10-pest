@props(['user'])
<div {{ $attributes->merge(['class' => 'flex items-center space-x-3 py-2']) }}>
    <div class="">
        <img class='object-cover rounded-full' alt='{{ $user->profile->fullname ?? $user->name }}' src='{{ image_profile($user) }}' />
    </div>
    <div class="flex flex-col space-y-2 w-full">
        <div class="flex justify-between items-center">
            <div class="text-sm font-semibold"> {{ $user->profile->fullname ?? '--' }} </div>
            <div class="text-gray-400 text-xs font-semibold tracking-wide"> {{ $user->name }} </div>
        </div>
        <div class="flex justify-between items-center">
            <div class="text-sm font-semibold"> {{ $user->email }} </div>
            <div class="text-gray-400 text-xs font-semibold tracking-wide"> {{ $user->profile->phone ?? '--' }} </div>
        </div>
    </div>
</div>