<table {{ $attributes->merge(['class' => 'w-full rounded-lg divide-y divide-gray-400 dark:divide-gray-500 overflow-hidden bg-gray-400 text-gray-900 dark:bg-gray-900 dark:text-gray-200 mb-1 text-xs md:text-sm']) }}>
    <thead {{ $attributes->merge(['class' => 'text-left']) }}>
        {{ $thead }}
    </thead>
    <tbody {{ $attributes->merge(['class' => 'bg-gray-200 text-gray-900 dark:bg-gray-600 dark:text-gray-200 divide-y divide-gray-400 dark:divide-gray-500']) }}>
        {{ $tbody }}
    </tbody>
    <tfoot {{ $attributes->merge(['class' => 'text-left']) }}>
        {{ $tfoot ?? '' }}
    </tfoot>
</table>