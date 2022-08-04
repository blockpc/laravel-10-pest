<div>
    <div class="fixed top-4 inset-x-0 z-10" x-data="{
        open: @entangle('open'),
        type: @entangle('type')
    }"
    x-init="$watch('open', value => setTimeout(() => open = false, 3000))">
        <div class="sm:w-3/4 md:w-1/2 mx-auto cursor-pointer" :class="type" x-show="open" x-on:click="open=false" x-transition>
            <div class="flex">
                <div class="flex-1">
                    @if ( $title )
                    <p class="font-bold">{{$title}}</p>
                    @endif
                    <p class="text-sm font-roboto font-medium">{!! $message !!}</p>
                </div>
                <button type="button" class="btn-sm" wire:click="hide()">
                    <x-bx-x class="w-4 h-4" />
                </button>
            </div>
        </div>
    </div>
</div>