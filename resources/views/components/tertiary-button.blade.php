@props([
    'tag' => 'button',
])

@php
    $tag = $attributes->has('href') ? 'a' : 'button';
@endphp

<{{$tag}}
    {{ $attributes->merge([
        'class' => 'btn btn-tertiary'
    ])}}
>
    {{ $slot }}
</{{$tag}}>
