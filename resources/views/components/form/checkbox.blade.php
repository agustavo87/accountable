@props([
    'name' => '',
    'id' => ''
])
<div class="flex items-center">
    <input
        {{ $attributes->merge([
            'class' => 'h-4 w-4 rounded-sm border-gray-300 text-deep-light focus:ring-turquoise'
        ]) }}
        id="{{ $id }}"
        name="{{ $name }}"
        type="checkbox"
    />  
    <label
        for="{{ $id }}"
        class="ml-2 block text-sm text-gray-700"
        >Remember me</label
    >
</div>