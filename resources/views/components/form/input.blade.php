@props([
    'label',
    'input',
    'id',
])
<div {{ $attributes }}>
    <label {{ $label->attributes->merge([
        'for' => $id,
        'class' => "label"
    ]) }} >
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