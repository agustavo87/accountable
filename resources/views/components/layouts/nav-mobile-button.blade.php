@props(['route' => '', 'text' => '', 'current' => false])
<a
    href="{{ route( $route ) }}"
    @class([
        'block pl-3 pr-4 py-2 border-l-4 text-base font-medium',
        'bg-indigo-50 border-indigo-500 text-indigo-700' => $current,
        'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' => !$current
    ])
    aria-current="page"
>
    {{ $text }}
</a>