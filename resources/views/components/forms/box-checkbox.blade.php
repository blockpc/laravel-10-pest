@props(['name', 'title', 'type' => 'text', 'required' => false])

<div class="flex flex-col md:flex-row text-xs font-semibold md:text-sm space-y-2 sm:space-y-0">
    <label class="w-full md:w-1/3 label" for="{{$name}}">{{__($title)}}</label>
    <div class="flex flex-col space-y-2 w-full md:w-2/3 mt-1 md:mt-0">
        <input type="checkbox" name="{{$name}}" id="{{$name}}" class="w-4 h-4 bg-gray-300 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-500 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800" {{$required ? 'required' : ''}}  {{$attributes->wire('model')}}>
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>