<select 
    {{ $attributes->merge([
        'class' => 'w-full sm:w-auto bg-white border-gray-50 shadow-sm font-medium text-gray-600 rounded-sm pl-4 pr-11 py-2  cursor-pointer focus:outline-none focus:ring-2 focus:border-gray-50 focus:ring-gray-200'
    ])}}
>
    {{ $slot }}
</select>