@props([
    'label' => 'Email',
    'name' => 'email',
    'id' => 'email'
])
<div>
    <label
        for="{{ $id }}"
        class="block text-sm font-medium text-gray-500 "
        >{{ $label }}</label
    >
    <div class="mt-1">
        <input
            {{ $attributes->merge([
                'class' => 'block w-full bg-gray-50 px-3 py-2 focus:border-turquoise placeholder-gray-400 shadow-sm sm:text-sm border-0 border-b border-gray-300  focus:bg-blue-50 focus:ring-0 transition'
            ]) }}
            id="{{ $id }}"
            name="{{ $name }}"
        />
    </div>
</div>