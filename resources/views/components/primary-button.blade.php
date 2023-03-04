<a
    {{ $attributes->merge(['class' => 'inline-flex items-center rounded-none border border-transparent bg-deep-light px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-deep active:bg-deep-dark transition focus:outline-none focus:ring-2 focus:ring-deep-white']) }}
>
    {{ $slot }}
</a>