@if ( session()->has('error') && $error = session('error') )
<div class="alert-danger my-2" id="alert-message-error">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Error')}}!</p>
            <p class="text-sm">{!! $error !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-error')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
        </button>
    </div>
</div>
@endif
@if ( session()->has('success') && $success = session('success') )
<div class="alert-success my-2" id="alert-message-success">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Success')}}!</p>
            <p class="text-sm">{!! $success !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-success')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
        </button>
    </div>
</div>
@endif
@if ( session()->has('info') && $info = session('info') )
<div class="alert-info my-2" id="alert-message-info">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Info')}}!</p>
            <p class="text-sm">{!! $info !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-info')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
        </button>
    </div>
</div>
@endif
@if ( session()->has('warning') && $warning = session('warning') )
<div class="alert-warning my-2" id="alert-message-warning">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Warning')}}!</p>
            <p class="text-sm">{!! $warning !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-warning')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
        </button>
    </div>
</div>
@endif