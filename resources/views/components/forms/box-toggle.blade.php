@props(['name','title', 'yes' => 'Si', 'not' => 'No', 'color' => 'blue', 'required' => false])

<div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0" x-data="{toogle: @entangle($attributes->wire('model')->value())}">
    <label class="w-full lg:w-1/3 label" for="{{$name}}">{{__($title)}} {!! $required ? '<span class="ml-1 text-red-600 dark:text-red-400">*</span>' : '' !!}</label>
    <div class="flex flex-col space-y-2 w-full lg:w-2/3 mt-1 lg:mt-0">
        <label for="{{$name}}" class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox" id="{{$name}}" class="sr-only peer" {{ $attributes->except('class') }}>
            <div class="w-11 h-6 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-{{$color}}-300 dark:peer-focus:ring-{{$color}}-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-{{$color}}-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-{{$color}}-600 peer-checked:bg-{{$color}}-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300" x-show="toogle">{{$yes}}</span>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300" x-show="!toogle">{{$not}}</span>
        </label>
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>