@props(['name', 'title', 'options', 'required' => false])

<div class="flex flex-col md:flex-row text-xs md:text-sm items-center">
    <label class="w-full md:w-1/3" for="{{$name}}">{{__($title)}}</label>
    <div class="flex flex-col space-y-2 w-full md:w-2/3 mt-1 md:mt-0">
        <select {{ $attributes->except('class') }} name="{{$name}}" id="{{$name}}" class="text-sm text-dark bg-dark w-full rounded-md @error( $attributes->wire('model')->value() ) border-error @enderror">
            <option value="">{{__('common.select')}}...</option>
            @foreach ($options as $option_key => $option_value)
                <option value="{{$option_key}}">{{$option_value}}</option>
            @endforeach
        </select>
        @error( $attributes->wire('model')->value() )
            <div class="text-error">{{$message}}</div>
        @enderror
    </div>
</div>