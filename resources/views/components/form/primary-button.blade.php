<button
    {{ $attributes->merge([
            'class' => 'flex justify-center rounded-sm border border-transparent transition-colors bg-deep py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-deep-light focus:outline-none focus:ring-2 focus:ring-deep-light focus:ring-offset-2 active:bg-deep-dark'
    ]) }}
>
    {{ $slot }}
</button>