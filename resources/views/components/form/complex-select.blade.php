@props([
    'id',
    'options',
    'label',
    'emptyClass' => 'text-gray-400',
])

<div 
    x-data="{value: @entangle($attributes->wire('model')) }"
    {{ $attributes->merge(['class' => 'flex flex-col']) }} 
>
    <label 
        for="{{ $id }}"
        class="block text-sm font-medium text-gray-700"
    >
        {{ $label }}
    </label>
    <select
        x-model="value"
        id="{{ $id }}"
        name="{{ $id }}"
        x-bind:class="!value ? '{{ $emptyClass }}' : ''"
        {{ $options->attributes->merge([
            'id' => $id,
            'name' => $id,
            'class' => "select"
        ])}}
        
    >
        {{ $options }}
    </select>
    {{ $slot }}
</div>