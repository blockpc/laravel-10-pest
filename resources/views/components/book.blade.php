@props(['book'])

<div class="bg-slate-100 p-3 rounded flex justify-between items-center">

    <div>
        <h2 class="font-semibold text-lg text-slate-800">{{ $book->title }}</h2>
        <div class="text-sm text-slate-600">{{ $book->author }}</div>
    </div>

    @isset($links)
    <div class="text-sm text-slate-600">
        {{ $links }}
    </div>
    @endisset

</div>
