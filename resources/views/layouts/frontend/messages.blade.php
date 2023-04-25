@if ( session()->has('error') && $error = session('error') )
<div class="alert alert-danger" id="alert-message-error">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Error')}}!</p>
            <p class="text-sm">{!! $error !!}.</p>
        </div>
        <button type="button" class="btn-sm mb-auto" onclick="closeAlert('alert-message-error')">
            <x-bx-x class="w-5 h-5" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('success') && $success = session('success') )
<div class="alert alert-success" id="alert-message-success">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Success')}}!</p>
            <p class="text-sm">{!! $success !!}.</p>
        </div>
        <button type="button" class="btn-sm mb-auto" onclick="closeAlert('alert-message-success')">
            <x-bx-x class="w-5 h-5" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('info') && $info = session('info') )
<div class="alert alert-info" id="alert-message-info">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Info')}}!</p>
            <p class="text-sm">{!! $info !!}.</p>
        </div>
        <button type="button" class="btn-sm mb-auto" onclick="closeAlert('alert-message-info')">
            <x-bx-x class="w-5 h-5" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('warning') && $warning = session('warning') )
<div class="alert alert-warning" id="alert-message-warning">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('Warning')}}!</p>
            <p class="text-sm">{!! $warning !!}.</p>
        </div>
        <button type="button" class="btn-sm mb-auto" onclick="closeAlert('alert-message-warning')">
            <x-bx-x class="w-5 h-5" />
        </button>
    </div>
</div>
@endif
