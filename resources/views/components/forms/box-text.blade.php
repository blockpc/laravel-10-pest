@props(['name', 'title', 'required' => false])

<div class="flex flex-col md:flex-row text-xs md:text-sm items-center">
    <label class="w-full md:w-1/3" for="{{$name}}">{{__($title)}}</label>
    <div class="flex flex-col space-y-2 w-full md:w-2/3 mt-1 md:mt-0">
        <input {{ $attributes->except('class') }} name="{{$name}}" id="{{$name}}" class="input input-sm @error( $attributes->wire('model')->value() ) border-error @enderror" type="text" placeholder="{{__($title)}}" {{ $required ? 'required' : '' }} />
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>