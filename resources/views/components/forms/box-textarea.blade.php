@props(['name', 'title', 'required' => false])

<div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0">
    <label class="w-full lg:w-1/3 label" for="{{$name}}">{{__($title)}} {!! $required ? '<span class="ml-1 text-red-600 dark:text-red-400">*</span>' : '' !!}</label>
    <div class="flex flex-col space-y-2 w-full lg:w-2/3 mt-1 lg:mt-0">
        <textarea {{ $attributes->except('class') }} name="{{$name}}" id="{{$name}}" 
            class="input text-xs @error( $attributes->wire('model')->value() ) border-error @enderror" 
            placeholder="{{__($title)}}" {{ $required ? 'required' : '' }} rows="5"
        ></textarea>
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>