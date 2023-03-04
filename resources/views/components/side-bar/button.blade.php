@props([
    'current' => null,
])

@php
    if(is_null($current)){
        if($current = url()->to($attributes['href']) == url()->current()) {
            $attributes['href'] = null;
        }
    }
@endphp


<div class="px-0">
    <a
        {{ 
            $attributes->class([
                'bg-deep  flex items-center px-2 py-2 text-base font-medium leading-6 rounded-none',
                'bg-opacity-75 text-white' => $current,
                'bg-opacity-0 text-deep-white hover:bg-opacity-25 hover:text-opacity-100' => !$current,
            ])
        }}
        {{ $current ? 'aria-current="page"' : ''}}
    >
        {{ $slot }}
    </a>
</div>