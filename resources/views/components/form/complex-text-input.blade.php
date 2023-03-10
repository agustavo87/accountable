@props([
    'label',
    'input',
    'id',
])
<div {{ $attributes }}>
    <label for="{{$id}}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <input id="{{$id}}"
        {{ $input->attributes->merge([
            'class' => "text-input",
            'name' => $id,
            'type' => 'text'
        ]) }}
        >
    @if($bind = $input->attributes->wire('model'))
        <x-error for="{{ $bind->value }}" />
    @endif
    {{$slot}}
</div>