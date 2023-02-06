@props(['route' => '', 'text' => '', 'current' => false])
<a
    href="{{ route($route) }}"
    @class([
        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium',
        'border-indigo-500 text-gray-900' => $current,
        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => !$current
    ])
    aria-current="page"
>
    {{ $text }}
</a>