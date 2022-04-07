@props(['user'])
<div {{ $attributes->merge(['class' => 'flex items-center space-x-3 py-2 w-64']) }}>
    <div class="inline-flex w-16 h-16">
        <img class='w-16 h-16 object-cover rounded-full' alt='{{ $user->profile->fullname ?? $user->name }}' src='{{ image_profile($user) }}' />
    </div>
    <div class="w-48">
        <p class="font-semibold"> {{ $user->name }} </p>
        <p class="text-gray-400 text-sm font-semibold tracking-wide"> {{ $user->profile->fullname ?? '--' }} </p>
        <p class="text-gray-400 text-xs font-semibold tracking-wide"> {{ $user->profile->phone ?? '--' }} </p>
    </div>
</div>