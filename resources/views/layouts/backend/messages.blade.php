@if ( session()->has('error') && $error = session('error') )
<div class="alert-danger my-2 p-2 md:p-4" id="alert-message-error">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Error')}}!</p>
            <p class="text-sm">{!! $error !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-error')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('success') && $success = session('success') )
<div class="alert-success my-2 p-2 md:p-4" id="alert-message-success">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Success')}}!</p>
            <p class="text-sm">{!! $success !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-success')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('info') && $info = session('info') )
<div class="alert-info my-2 p-2 md:p-4" id="alert-message-info">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Info')}}!</p>
            <p class="text-sm">{!! $info !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-info')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('warning') && $warning = session('warning') )
<div class="alert-warning my-2 p-2 md:p-4" id="alert-message-warning">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Warning')}}!</p>
            <p class="text-sm">{!! $warning !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-warning')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif