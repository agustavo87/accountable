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
                'bg-deep relative flex items-center px-2 py-2 text-base font-medium leading-6 rounded-none transition overflow-hidden',
                'bg-opacity-75 text-white pl-3.5 ' => $current,
                'bg-opacity-0 text-deep-white hover:bg-opacity-25 hover:text-opacity-100' => !$current,
            ])
        }}
        {{ $current ? 'aria-current="page"' : ''}}
    >
        @if($current)
            <div class="absolute border-4 border-turquoise left-0 top-0 bottom-0 w-3 -ml-2 rounded-md "></div>
        @endif
        {{ $slot }}
    </a>
</div>