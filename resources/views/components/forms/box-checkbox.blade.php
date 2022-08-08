@props(['name', 'title', 'type' => 'text', 'required' => false])

<div class="flex items-center text-xs font-semibold md:text-sm">
    <label class="w-1/3 label" for="{{$name}}">{{__($title)}} {!! $required ? '<span class="ml-1 text-red-600 dark:text-red-400">*</span>' : '' !!}</label>
    <div class="flex flex-col space-y-2 w-2/3 mt-0">
        <input type="checkbox" name="{{$name}}" id="{{$name}}" 
            class="w-4 h-4 bg-gray-300 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-500 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800" 
            {{$required ? 'required' : ''}}  {{$attributes->wire('model')}}
        >
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>