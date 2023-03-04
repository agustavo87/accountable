<a
    {{ $attributes->merge([
        'class' => 'inline-flex items-center rounded-none border bg-gray-100 border-gray-100 px-4 py-2 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 hover:text-gray-600 hover:border-gray-50 active:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-200'
    ])}}
>
    {{ $slot }}
</a>