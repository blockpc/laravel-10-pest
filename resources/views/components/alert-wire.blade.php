@if ( session()->has('error') )
<div class="alert-danger mb-4" id="alert-message-error">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('common.error')}}!</p>
            <p class="text-sm">{!! session('error') !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-error')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('success') )
<div class="alert-success mb-4" id="alert-message-success">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('common.success')}}!</p>
            <p class="text-sm">{!! session('success') !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-success')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('info') )
<div class="alert-info mb-4" id="alert-message-info">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('common.info')}}!</p>
            <p class="text-sm">{!! session('info') !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-info')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif
@if ( session()->has('warninng') )
<div class="alert-warninng mb-4" id="alert-message-warninng">
    <div class="flex">
        <div class="flex-1">
            <p class="font-bold">{{__('common.warning')}}!</p>
            <p class="text-sm">{!! session('warning') !!}.</p>
        </div>
        <button type="button" class="btn-sm" onclick="closeAlert('alert-message-warning')">
            <x-bx-x class="w-4 h-4" />
        </button>
    </div>
</div>
@endif